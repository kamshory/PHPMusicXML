<?php

class Sampah
{
    /**
     * Process note duration
     *
     * @param integer $timebase
     * @return void
     */
    private function processDuration($timebase)
    {
        $this->processDuration1($timebase);
        $this->processDuration2($timebase);
        $this->buildTimeDivisions($timebase);
    }

    /**
     * Prepare note information to calculate note duration
     *
     * @param integer $timebase
     * @return void
     */
    private function processDuration1($timebase) //NOSONAR
    {
        $lastTime = array();
        foreach ($this->measures as $ch => $chValue) {
            foreach ($chValue as $tmInteger => $tmIntegerValue) {
                foreach ($tmIntegerValue as $note => $noteValue) {
                    if(isset($noteValue['channel']) && isset($noteValue['note']))
                    {
                        $chIdx = $noteValue['channel'];
                        $noteIdx = $noteValue['note'];
                        $index = "n" . $chIdx . "_" . $noteIdx;
                        $lt = MusicXMLUtil::getLastTime($lastTime, $index);
                        $duration = $noteValue['time'] - $lt;
                        $this->measures[$ch][$tmInteger][$note]['duration'] = $duration;
                        $this->measures[$ch][$tmInteger][$note]['last'] = $lt;
                        $lastTime[$index] = $noteValue['time'];
                    }
                }

                // add rest before note here
                

            }
        }
    }

    /**
     * Calculate note duration by information provided before
     *
     * @param integer $timebase
     * @return void
     */
    private function processDuration2($timebase)
    {
        foreach ($this->measures as $ch => $chValue) {
            foreach ($chValue as $tmInteger => $tmIntegerValue) {
                foreach ($tmIntegerValue as $note => $noteValue) {
                    if (isset($this->measures[$ch][$tmInteger][$note]['time']) && isset($this->measures[$ch][$tmInteger][$note]['last'])) {
                        $duration = $this->measures[$ch][$tmInteger][$note]['time'] - $this->measures[$ch][$tmInteger][$note]['last'];
                        $duration = MusicXMLUtil::fixDuration($duration, $timebase);
                        $this->measures[$ch][$tmInteger][$note]['duration'] = $duration;
                    }
                }
            }
        }
    }
    
    public function processNoteDuration($timebase)
    {
        foreach($this->measures as $measure)
        {
            foreach($measure as $measureIndex => $events)
            {
                $minDuration = $timebase;
                foreach($events as $event)
                {
                    if(isset($event['channel']) && $event['channel'] != 10 &&  isset($event['duration']) && $event['duration'] > 0 && $event['duration'] < $minDuration)
                    {
                        
                    }
                }
            }
        }
    }

}