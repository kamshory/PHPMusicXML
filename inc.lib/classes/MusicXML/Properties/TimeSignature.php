<?php

namespace MusicXML\Properties;

class TimeSignature
{
    private $time = 0;
    private $beats = 0;
    private $beatType = 4;
    
    public function __construct($msg)
    {
        $this->time = $msg[0];
        $arr = explode("/", $msg[2]);
        $this->beats = $arr[0];
        $this->beatType = $arr[1];
    }

    /**
     * Get the value of time
     */ 
    public function getTime()
    {
        return $this->time;
    }

    /**
     * Set the value of time
     *
     * @return  self
     */ 
    public function setTime($time)
    {
        $this->time = $time;

        return $this;
    }

    /**
     * Get the value of beats
     */ 
    public function getBeats()
    {
        return $this->beats;
    }

    /**
     * Set the value of beats
     *
     * @return  self
     */ 
    public function setBeats($beats)
    {
        $this->beats = $beats;

        return $this;
    }

    /**
     * Get the value of beatType
     */ 
    public function getBeatType()
    {
        return $this->beatType;
    }

    /**
     * Set the value of beatType
     *
     * @return  self
     */ 
    public function setBeatType($beatType)
    {
        $this->beatType = $beatType;

        return $this;
    }
}