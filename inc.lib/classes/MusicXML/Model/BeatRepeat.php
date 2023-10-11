<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * BeatRepeat
 * @Xml
 * @Referece https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/beat-repeat/
 * @Data
 */
class BeatRepeat extends MusicXMLWriter
{
    /**
     * Type
     * 
     * @Attribute 
     * @var string
     */
    public $type;
    
    /**
     * Slashes
     * 
     * @Attribute
     * @var integer
     */
    public $slashes;
    
    /**
     * Use dots
     * 
     * @Attribute(name="use-dots") 
     * @var string
     */
    public $useDot;
    
    /**
     * Slash type
     * 
     * @PropertyElement
     * @var string
     */
    public $slashType;
    
    /**
     * Slash dot
     * 
     * @Element
     * @var SlashDot[]
     */
    public $slashDot;
    
    /**
     * Excpet voice
     * 
     * @Element
     * @var ExceptVoice[]
     */
    public $exceptVoice;
    

}

