<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Grace
 * @Xml
 * @Referece https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/grace/
 * @Data
 */
class Grace extends MusicXMLWriter
{
    /**
     * Make time
     * 
     * @Attribute(name="make-time") 
     * @var string
     */
    public $nameTime;
    
    /**
     * Slash
     * 
     * @Attribute 
     * @var string
     */
    public $slash;
    
    /**
     * Steal time following
     *
     * @Attribute(name="steal-time-following")
     * @var float
     */
    public $stealTimeFollowing;
    
    /**
     * Steal time
     *
     * @Attribute(name="steal-time-previous")
     * @var float
     */
    public $stealTimePrevious;
    
    
}