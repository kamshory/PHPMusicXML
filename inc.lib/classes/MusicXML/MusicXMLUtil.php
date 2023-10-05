<?php
namespace MusicXML;

use MusicXML\Model\Clef;
use MusicXML\Model\Direction;
use MusicXML\Model\DirectionType;
use MusicXML\Model\Metronome;
use MusicXML\Model\Sound;
use MusicXML\Properties\Coordinate;

class MusicXMLUtil
{

    /**
     * Get note coordinate
     *
     * @param integer $measureIndex
     * @param array $message
     * @param integer $divisions
     * @param integer $timebase
     * @return Coordinate
     */
    public static function getNoteCoordinate($measureIndex, $message, $divisions, $timebase)
    {
        $coordinate = new Coordinate();       
        $timeRelative = $message['abstime'] - ($measureIndex * $timebase);
        $coordinate->defaultX = ($timeRelative / $timebase) * $divisions;
        return $coordinate;
    }
    
    /**
     * Find last On
     *
     * @param array $messages
     * @return integer
     */
    public static function findLastOn($messages)
    {
        $last = 0;
        foreach ($messages as $idx => $note) {
            if ($note['event'] == 'On') {
                $last = $idx;
            }
        }
        return $last;
    }
    
    /**
     * Fix duration
     *
     * @param float $duration
     * @param integer $timebase
     * @return float
     */
    public static function fixDuration($duration, $timebase)
    {
        if($duration > 4/$timebase)
        {
            $duration = 4/$timebase;
        }
        return $duration;
    }
    
    /**
     * Get last time
     *
     * @param array $lastTime
     * @param string $index
     * @return float
     */
    public static function getLastTime($lastTime, $index)
    {
        if (isset($lastTime[$index])) {
            $lt = $lastTime[$index];
        } else {
            $lt = 0;
        }
        return $lt;
    }
    
    public static function getDirections($tempoList)
    {
        $lastBpm = 0;
        $directions = array();
        if(isset($tempoList))
        {
            foreach($tempoList as $value) 
            {
                $rawtime = $value['rawtime'];
                $bpm = $value['bpm'];
                if(!isset($directions[$rawtime]))
                {
                    $directions[$rawtime] = new Direction();
                }
                if($bpm != $lastBpm)
                {
                    $sound = new Sound();
                    $sound->tempo = $bpm;
                    $directions[$rawtime]->sound = $sound;
                    
                    $directionType = new DirectionType();
                    $metronome = new Metronome();
                    $metronome->parentheses = 'no';
                    $metronome->perMinute = $bpm;
                    $metronome->beatUnit = 'quarter';
                    $directionType->metronome = $metronome;
                    
                    $directions[$rawtime]->directionType = $directionType;
                    $directions[$rawtime]->placement = 'above';
                    
                    
                    $lastBpm = $bpm;
                }
            }
        }
        return $directions;
    }
    
    /**
     * Get clef from notes
     *
     * @param integer $min
     * @param integer $max
     * @return Clef[]
     */
    public static function getClef($min, $max)
    {
        $clefs = array();
        for($i = $max; $i > $min; $i-=36)
        {
            $clef1 = new Clef();
            $clef1->sign = 'G';
            $clef1->line = 2;
            $clefs[] = $clef1;
        }        
        
        return $clefs;
    }
}