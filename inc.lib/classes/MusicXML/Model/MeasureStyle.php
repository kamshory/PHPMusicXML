<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * MeasureStyle
 * @Xml
 * @Referece https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/measure-style/
 * @Data
 */
class MeasureStyle extends MusicXMLWriter
{
    /**
     * Color
     * 
     * @Attribute 
     * @var string
     */
    public $color;
    
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
     * ID
     * 
     * @Attribute
     * @var string
     */
    public $id;
    
    /**
     * Number
     * 
     * @Attribute
     * @var string
     */
    public $number;
    
    /**
     * Multiple rest
     *
     * @Element(name="multiple-rest")
     * @var MultipleRest
     */
    public $multipleRest;
    
    /**
     * Multiple repeat
     *
     * @PropertyElement(name="multiple-repeat")
     * @var string
     */
    public $multipleRepeat;
    
    
    /**
     * Beat repeat
     *
     * @Element(name="beat-repeat")
     * @var BeatRepeat
     */
    public $beatRepeat;

    /**
     * Slash
     *
     * @Element
     * @var Slash
     */
    public $slash;

    /**
     * Measure repeat
     *
     * @Element(name="measure-repeat")
     * @var MeasureRepeat
     */
    public $measureRepeat;
}

