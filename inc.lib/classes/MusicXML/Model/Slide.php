<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Slide
 * @Xml
 * @Path /path/measure/note/notation/slide
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/slide/
 * @Data
 */
class Slide extends MusicXMLWriter
{
    /**
     * Type
     *
     * @Attribute
     * @var string
     */
    public $type;
    
    /**
     * Accelerate
     *
     * @Attribute
     * @var string
     */
    public $accelerate; 
    
    /**
     * Beats
     *
     * @Attribute
     * @var string
     */
    public $beats;
    
    /**
     * Color
     *
     * @Attribute
     * @var string
     */
    public $color;
    
    /**
     * Dash length
     *
     * @Attribute(name="dash-length")
     * @var float
     */
    public $dashLength;
    
    
    
    /**
     * Default x
     * 
     * @Attribute(name="default-x)
     * @var float
     */
    public $defaultX;
    
    /**
     * Default y
     * 
     * @Attribute(name="default-y)
     * @var float
     */
    public $defaultY;
    
    /**
     * First beat
     * 
     * @Attribute(name="first-beat)
     * @var float
     */
    public $firstBeat;
    
    /**
     * Font family
     * 
     * @Attribute(name="font-family")
     * @var string
     */
    public $fontFamily;
    
    /**
     * Font size
     * 
     * @Attribute(name="font-size")
     * @var string
     */
    public $fontSize;
    
    /**
     * Font style
     * 
     * @Attribute(name="font-style")
     * @var string
     */
    public $fontStyle;
    
    /**
     * Font weight
     * 
     * @Attribute(name="font-weight")
     * @var string
     */
    public $fontWeight;
    
    /**
     * ID
     * 
     * @Attribute
     * @var string
     */
    public $id;
    
    /**
     * Last beat
     * 
     * @Attribute(name="last-beat)
     * @var float
     */
    public $lastBeat;
    
    /**
     * Number
     *
     * @Attribute
     * @var integer
     */
    public $number;
    
    /**
     * Relative X
     * 
     * @Attribute(name="relative-x")
     * @var string
     */
    public $relativeX;
    
    /**
     * Relative Y
     * 
     * @Attribute(name="relative-y")
     * @var string
     */
    public $relativeY;
    
    /**
     * Space length
     * 
     * @Attribute(name="space-length")
     * @var float
     */
    public $spaceLength;
    
    /**
     * Text content
     *
     * @TextContent
     * @var string
     */
    public $textContent;
}