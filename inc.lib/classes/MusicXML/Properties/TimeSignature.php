<?php

namespace MusicXML\Properties;

class TimeSignature
{
    public $time = 0;
    public $beats = 0;
    public $beatType = 4;
    
    public function __construct($msg)
    {
        $this->time = $msg[0];
        $arr = explode("/", $msg[2]);
        $this->beats = $arr[0];
        $this->beatType = $arr[1];
    }
}