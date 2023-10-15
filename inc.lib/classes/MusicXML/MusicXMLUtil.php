<?php
namespace MusicXML;

use MusicXML\Model\BeatUnit;
use MusicXML\Model\Clef;
use MusicXML\Model\Direction;
use MusicXML\Model\DirectionType;
use MusicXML\Model\Line;
use MusicXML\Model\Metronome;
use MusicXML\Model\MetronomeRelation;
use MusicXML\Model\PerMinute;
use MusicXML\Model\Sign;
use MusicXML\Model\Sound;
use MusicXML\Model\Work;
use MusicXML\Model\WorkTitle;
use MusicXML\Properties\AttackRelease;
use MusicXML\Properties\Coordinate;

class MusicXMLUtil
{
    /**
     * Dget note type
     *
     * @param integer $duration
     * @param integer $divisions
     * @return string
     */
    public static function getNoteType($duration, $divisions)
    {
        $value = $duration/(4*$divisions);
        foreach(self::$type as $type=>$valueType)
        {
            if($value > $valueType)
            {
                return $type;
            }
        }
        return 'whole';
    }
    protected static $type = array(
        'maxima'=>5,
        'long'=>4,
        'breve'=>2,
        'whole'=>1,
        'half'=>1/2,
        'quarter'=>1/4,
        'eighth'=>1/8,
        '16th'=>1/16,
        '32nd'=>1/32,
        '64th'=>1/64,
        '128th'=>1/128,
        '256th'=>1/256,
        '512th'=>1/512,
        '1024th'=>1/1024
    );
    

    /**
     * Get note coordinate
     *
     * @param integer $measureIndex
     * @param array $message
     * @param integer $divisions
     * @param integer $timebase
     * @param float $width
     * @return Coordinate
     */
    public static function getNoteCoordinate($measureIndex, $message, $divisions, $timebase, $timeSignature, $width)
    {
        $coordinate = new Coordinate();       
        $timeRelative = $message['abstime'] - ($measureIndex * $timebase);
        $coordinate->defaultX = $timeRelative * $width * $timeSignature->getBeats() / ($divisions*$timebase);
        return $coordinate;
    }
    
    /**
     * Get note coordinate
     *
     * @param integer $measureIndex
     * @param array $message
     * @param integer $divisions
     * @param integer $timebase
     * @param integer $duration
     * @return AttackRelease
     */
    public static function getAttackRelease($measureIndex, $message, $timebase, $timeSignature, $duration)
    {
        $timeRelative = $message['abstime'] - ($measureIndex * $timebase);
        $attack = $timeRelative * $timeSignature->getBeats() / ($timebase);
        $release = $attack + $duration;
        return new AttackRelease($attack, $release);     
    }
    
    /**
     * Get work
     *
     * @param string $title
     * @return Work
     */
    public static function getWork($title)
    {
        $work = new Work();
        $work->workTitle = new WorkTitle($title);
        return $work;
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
                    $metronome->perMinute = new PerMinute($bpm);
                    $metronome->beatUnit = new BeatUnit('quarter');
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
        $mod = $min % 12;

        $clefs = array();
        for($i = $max; $i > $min; $i-=36)
        {
            $clef1 = new Clef();
            if($mod >= 5)
            {
                $clef1->sign = new Sign('F');
                $clef1->line = new Line(4);
            }
            else
            {
                $clef1->sign = new Sign('G');
                $clef1->line = new Line('2');
            }
            $clefs[] = $clef1;
        }        
        
        return $clefs;
    }
    
    /**
     * Get programs
     *
     * @param array $midiEventMessages
     * @return array
     */
    public static function getControlEvent($midiEventMessages)
    {
        $messages = array();
        foreach ($midiEventMessages as $message) {
            if (isset($message['event']) && $message['event'] != 'On' && $message['event'] != 'Off') {
                $messages[] = $message;
            }
        }
        return $messages;
    }
    
    /**
     * Get minimum duration
     *
     * @param array $midiEventMessages
     * @param integer $timebase
     * @return float
     */
    public static function getMinimumDuration($midiEventMessages, $timebase)
    {
        $min = $timebase;
        foreach ($midiEventMessages as $message) {
            if (isset($message['duration']) && $message['duration'] > 0 && $message['duration'] < $min) {
                $min = $message['duration'];
            }
        }
        return $min;
    }

    /**
     * Get notes
     *
     * @param array $midiEventMessages
     * @return array
     */
    public static function getNotes($midiEventMessages)
    {
        $messages = array();
        foreach ($midiEventMessages as $message) {
            if (isset($message['event']) && ($message['event'] == 'On' || $message['event'] == 'Off')) {
                $messages[] = $message;
            }
        }
        return $messages;
    }
    
    /**
     * Get index of note of channel
     *
     * @param array $noteMessages
     * @param integer $time
     * @param integer $timebase
     * @return integer | false
     */
    public static function getNoteIndex($noteMessages, $time, $timebase)
    {
        // reverse
        $keys = array_keys($noteMessages);
        $reversed = array_reverse($keys);
        foreach($reversed as $key)
        {
            $duration = isset($noteMessages[$key]['duration']) ? $noteMessages[$key]['duration'] * $timebase : 0;
            if($noteMessages[$key]['time'] < $time && ($noteMessages[$key]['time'] + $duration) > $time)
            {
                return $key;
            }
        }
        return false;
    }
    
    /**
     * Get instrument  name
     *
     * @param integer $instrumentId
     * @param integer $channelId
     * @return array
     */
    public static function getInstrumentName($instrumentId, $channelId)
    {
        if ($channelId == 10) {
            $id = $instrumentId + 1;
            if(isset(MusicXMLInstrument::DRUM_SET[$instrumentId]))
            {
                return MusicXMLInstrument::DRUM_SET[$instrumentId];
            }
            else
            {
                return array('Instrument ' . $id, 'Instrument ' . $id);
            }
            
        } else {
            return MusicXMLInstrument::INSTRUMENT_LIST[$instrumentId];
        }
    }

}