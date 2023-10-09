<?php

namespace MusicXML\Properties;

class Coordinate
{
    /**
     * Default X
     * 
     * @var float
     */
    public $defaultX;
    
    /**
     * Default Y
     * 
     * @var float
     */
    public $defaultY;
    
    /**
     * Relative X
     * 
     * @var string
     */
    public $relativeX;
    
    /**
     * Relative Y
     * 
     * @var string
     */
    public $relativeY;
    
    public function __toString()
    {
        return json_encode($this);
    }
}