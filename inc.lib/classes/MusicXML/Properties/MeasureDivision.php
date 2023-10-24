<?php

namespace MusicXML\Properties;

class MeasureDivision
{
    private $minimum = 0;
    private $maximum = 0;
    private $division = 0;
    
    /**
     * Constructor
     *
     * @param integer $timebase
     * @param array $notes
     */
    public function __construct($timebase, $notes)
    {
        $arr = array();
        foreach($notes as $note)
        {
            $arr[] = $note['abstime'] % $timebase;
            $arr[] = $note['duration'];
        }
        $this->minimum = $arr[0];
        $this->maximum = $arr[count($arr) -1];
        $this->division = $this->calculate($timebase, $arr);
    }
    
    /**
     * Get divisor
     *
     * @param integer $n
     * @return integer[]
     */
    private function getDivisor($n) {
        $arr = array();
        for($i = 1; $i <= $n; $i++) 
        {
            if($n % $i == 0)
            {
                $arr[] = $i;
            }
        }
        return $arr;
    }
    
    private function calculate($timebase, $array)
    {
        $divs = $this->getDivisor($timebase);

        $i = 0;
        $factor = $timebase / $divs[$i];
        $arr = $array;
        
        foreach($arr as $idx=>$element)
        {
            if($element % $factor == 0)
            {
                unset($arr[$idx]);
            }
        }
        if(empty($arr))
        {
            return $divs[$i];
        }
        do
        {
            $i++;
            $factor = $timebase / $divs[$i];
            $arr = $array;
            foreach($arr as $idx=>$element)
            {
                if($element % $factor == 0)
                {
                    unset($arr[$idx]);
                }
            }
            if(empty($arr))
            {
                return $divs[$i];
            }
                
        }
        while($factor < $timebase);
        return $timebase;
    }

    /**
     * Get the value of division
     */ 
    public function getDivision()
    {
        return $this->division;
    }

    /**
     * Get the value of minimum
     */ 
    public function getMinimum()
    {
        return $this->minimum;
    }

    /**
     * Get the value of maximum
     */ 
    public function getMaximum()
    {
        return $this->maximum;
    }
}