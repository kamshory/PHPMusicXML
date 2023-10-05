<?php
namespace MusicXML;

class MusicXMLUtil{
 
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
}