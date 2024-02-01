<?php

namespace Midi;

use stdClass;

class MidiInstrument extends Midi{
	protected $program = array();
	
	public function getInstrument()
	{
		$midi = $this;
		$program = new stdClass();
		$program->tempo = $this->tempo;
		$program->program = new stdClass();
		$program->time = new stdClass();
		$program->program->tracks = array();
		$program->program->parsed = array();
		$program->time->tracks = array();
		$instruments = $this->getInstrumentList();
		foreach($midi->tracks as $i=>$track)
		{
			$program->program->tracks[$i] = array();
			$j = 0;
			$k = 0;
			foreach($track as $j=>$raw)
			{
				$arr = explode(' ', $raw, 4);
				$time = $arr[0];
				$type = $arr[1];
				$data = $arr[2];
				if($type == 'PrCh')
				{

					list(, $ch) = explode('=', $arr[2]);
					list(, $p) = explode('=', $arr[3]);
					

					$program->program->tracks[$i][$k] = $raw;
					$program->program->parsed[$i][$k] = array(
						'channel'=>$ch, 
						'program'=>$p,
						'instrument'=>$instruments[$p]
					);
					$k++;
				}
			}
		}
		foreach($midi->tracks as $i=>$track)
		{
			$program->time->tracks[$i] = array();
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
					$program->time->tracks[$i][$k] = $raw;
					$k++;
				}
			}
		}
		
		$program->timebase = $this->getTimebase();
		return $program;
	}
	public function getMidData()
	{
		$midi = new StdClass();
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
	 * returns absolute time in mili seconds
	 *
	 * @access public
	 * @return int absolute time
	 */
	function getAbsoluteTime($relativeTime)
	{
		$duration = 0;
		$currentTempo = 0;
		$t = 0;
		
		$track = $this->tracks[0];
		
		
		$f = 1 / $this->getTimebase() / 1000000;
		
		foreach($this->tracks as $trk)
		{
			$mc = count($trk);
			for ($i=0;$i<$mc;$i++)
			{
				$msg = explode(' ',$trk[$i]);
				
				$tm = (int)@$msg[0];
				if($tm > $relativeTime)
				{
					break 2;
				}
				
				if (@$msg[1]=='Tempo')
				{
					$dt = (int)$msg[0] - $t;
					$duration += $dt * $currentTempo * $f;
					$t = (int)$msg[0];
					$currentTempo = (int)$msg[2];
				}
			}
		}
		
		$dt = $relativeTime - $t;
		$duration += $dt * $currentTempo * $f;
		return $duration * 1000;
	}
	
	
}
