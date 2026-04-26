<?php

namespace Midi;

use \stdClass;

/**
 * Class MidiInstrument
 * 
 * Extends Midi to handle instrument (program change) extraction and data mapping.
 * 
 * @package Midi
 */
class MidiInstrument extends Midi{

	/**
	 * Program
	 * @var array
	 */
	protected $program = array();
	
	/**
	 * Get instrument and tempo information
	 * 
	 * Parses tracks for program change (PrCh) events and tempo settings.
	 *
	 * @return stdClass
	 */
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
			$k = 0;
			foreach($track as $j=>$raw)
			{
				$arr = explode(' ', $raw, 4);
				$type = $arr[1];
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
			$k = 0;
			foreach($track as $j=>$raw)
			{
				$arr = explode(' ', $raw, 3);
				$type = $arr[1];
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

	/**
	 * Get MIDI data without copyright events
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
	
}
