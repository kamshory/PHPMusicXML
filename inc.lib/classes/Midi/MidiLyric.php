<?php

namespace Midi;

use \stdClass;

/**
 * Class MidiLyric
 * 
 * Extends Midi to handle lyrics extraction and insertion.
 * 
 * @package Midi
 */
class MidiLyric extends Midi{

	/**
	 * Lyrics
	 * @var array
	 */
	protected $lyric = array();

	/**
	 * returns lyrics and tempo information as an object
	 *
	 * @return stdClass
	 */
	public function getLyric()
	{
		$midi = $this;
		$lyric = new stdClass();
		$lyric->tempo = $this->getTempo();
		$lyric->lyric = new stdClass();
		$lyric->time = new stdClass();
		$lyric->lyric->tracks = array();
		$lyric->time->tracks = array();
		
		foreach($midi->tracks as $i=>$track)
		{
			$lyric->lyric->tracks[$i] = array();
			$j = 0;
			$k = 0;
			foreach($track as $j=>$raw)
			{
				$arr = explode(' ', $raw, 3);
				$time = $arr[0];
				$type = $arr[1];
				$data = $arr[2];
				if($type == 'Meta' && stripos($data, 'Lyric ') === 0)
				{
					$lyric->lyric->tracks[$i][$k] = $raw;
					$k++;
				}
			}
		}
		foreach($midi->tracks as $i=>$track)
		{
			$lyric->time->tracks[$i] = array();
			$j = 0;
			$k = 0;
			foreach($track as $j=>$raw)
			{
				$arr = explode(' ', $raw, 3);
				$time = $arr[0]; // NOSONAR
				$type = $arr[1];
				$data = $arr[2]; // NOSONAR
				if($type == 'Tempo')
				{
					$lyric->time->tracks[$i][$k] = $raw;
					$k++;
				}
			}
		}
		
		$lyric->timebase = $this->getTimebase();
		return $lyric;
	}

	/**
	 * get MIDI data without copyright events
	 *
	 * @return stdClass
	 */
	public function getMidData()
	{
		$midi = new stdClass();
		$midi->tempo = $this->tempo;
		$midi->timebase = $this->timebase;
		$midi->tempoMsgNum = $this->tempoMsgNum;
		$midi->type = $this->type;
		$midi->throwFlag = $this->throwFlag;
		$midi->tracks = array();
		
		foreach($this->tracks as $i=>$track)
		{
			$midi->tracks[$i] = array();
			foreach($track as $j=>$raw)
			{
				if(stripos($raw, 'copyright') === false)
				{
					$midi->tracks[$i][] = $raw;
				}
			}
		}
		return $midi;
	}
	
	
	/**
	 * set the lyric data
	 *
	 * @param array|stdClass $lyric
	 * @return void
	 */
	public function addLyric($lyric)
	{
		$this->lyric = $lyric;
	}

	/**
	 * saves MIDI song as Standard MIDI File
	 *
	 * @param string $mid_path
	 * @param mixed $chmod
	 * @return void
	 */
	public function saveMidFile($mid_path, $chmod=false)
	{
		if (count($this->tracks)<1) $this->_err('MIDI song has no tracks');
		$SMF = fopen($mid_path, "wb"); // SMF
		$data = $this->getMidWithLyric($this->lyric);
		fwrite($SMF, $data);
		fclose($SMF);
		if ($chmod!==false) @chmod($mid_path, $chmod);
	}

	/**
	 * returns binary MIDI string
	 *
	 * @param stdClass $lyric
	 * @return string
	 */
	public function getMidWithLyric($lyric)
	{
		$tracks = $this->tracks;
		$tracks = $this->updateLyric($tracks, $lyric);
		$tc = count($tracks);
		$type = ($tc > 1)?1:0;
		$midStr = "MThd\0\0\0\6\0".chr($type).$this->_getBytes($tc,2).$this->_getBytes($this->timebase,2);
		for ($i=0;$i<$tc;$i++)
		{
			$track = $tracks[$i];
			$mc = count($track);
			$time = 0;
			$midStr .= "MTrk";
			$trackStart = strlen($midStr);

			$last = '';

			for ($j=0;$j<$mc;$j++)
			{
				$line = $track[$j];
				$t = $this->_getTime($line);
				$dt = $t - $time;

				if ($dt<0)
				{
					continue;
				}
				$time = $t;
				$midStr .= $this->_writeVarLen($dt);
				// repetition, same event, same channel, omit first byte (smaller file size)
				$str = $this->_getMsgStr($line);
				$start = ord($str[0]);
				if ($start>=0x80 && $start<=0xEF && $start==$last) $str = substr($str, 1);
				$last = $start;
				$midStr .= $str;
			}
			$trackLen = strlen($midStr) - $trackStart;
			$midStr = substr($midStr,0,$trackStart).$this->_getBytes($trackLen,4).substr($midStr,$trackStart);
		}
		return $midStr;
	}

	/**
	 * update lyrics in tracks
	 *
	 * @param array $tracks
	 * @param stdClass $lyric
	 * @return array
	 */
	public function updateLyric($tracks, $lyric)
	{
		$tc = count($tracks);
		$type = ($tc > 1)?1:0;
		for ($i=0;$i<$tc;$i++)
		{
			$mc = count($tracks[$i]);
			$copy = array();
			for($j=0;$j<$mc;$j++)
			{
				$line = $tracks[$i][$j];
				$arr = explode(' ', $line, 4);
				if($arr[2] == 'Lyric')
				{
					// remove existing lyric if any
				}
				else
				{
					$copy[] = $tracks[$i][$j];
				}
			}
			if(isset($lyric->tracks[$i]))
			{
				// Insert lyric if any
				$tracks[$i] = $this->insertMid($copy, $lyric->tracks[$i]);
			}
		}
		return $tracks;
	}

	/**
	 * insert lyrics into track
	 *
	 * @param array $track
	 * @param array $lyric
	 * @return array
	 */
	public function insertMid($track, $lyric)
	{
		$trackResult = array();
		$mc1 = count($track);
		$mc2 = count($lyric);
		$lt1 = 0;
		$lt2 = 0;
		$lt3 = 0;
		$maxIdx = 0;
		if(count($track) > 0)
		{
			$trackResult[] = $track[0];
		}
		for($i=1; $i<$mc1; $i++)
		{
			$line1 = $track[$i-1];
			$line2 = $track[$i];
			$arr1 = explode(' ', $line1, 2);
			$arr2 = explode(' ', $line2, 2);

			$lt1 = $arr1[0];
			$lt2 = $arr2[0];
			
			for($j = $maxIdx; $j < $mc2; $j++)
			{
				$line3 = $lyric[$j];
				$arr3 = explode(' ', $line3, 2);
				$lt3 = $arr3[0];
				if($lt3 >= $lt1 && $lt3 < $lt2)
				{
					$trackResult[] = $line3;
					$maxIdx = $j+1;
				}
			}
			$trackResult[] = $line2;
		}
		return $trackResult;
	}
}
