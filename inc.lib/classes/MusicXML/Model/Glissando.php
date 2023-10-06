<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Footnote
 * @Xml
 * @Referece https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/glissando/
 * @Data
 */
class Glissando extends MusicXMLWriter
{
    /**
     * @Attribute 
     * @var string
     */
    public $type;
    
    /**
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
     * Default X
     * 
     * @Attribute(name="default-x") 
     * @var float
     */
    public $defaultX;
    
    /**
     * Default Y
     * 
     * @Attribute(name="default-y") 
     * @var float
     */
    public $defaultY;
    
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
     * id
     * 
     * @Attribute
     * @var string
     */
    public $id;
    
    /**
     * Line type
     * 
     * @Attribute(name="line-type")
     * @var string
     */
    public $lineType;
    
    /**
     * Number
     * 
     * @Attribute
     * @var float
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
     * Description
     *
     * @TextContent
     * @var string
     */
    public $textContent;

}

