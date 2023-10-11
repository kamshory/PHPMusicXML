<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Key
 * @Xml
 * @Path /path/measure/attribute/key
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/key/
 * @Data
 */
class Key extends MusicXMLWriter
{
    
    /**
     * Color
     * 
     * @Attribute(name="color") 
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
     * Relative X
     * 
     * @Attribute(name="relative-x")
     * @var string
     */
    public $relativeX;
    
    /**
     * Print object
     * 
     * @Attribute(name="print-object")
     * @var string
     */
    public $printObject;
    
    /**
     * Relative Y
     * 
     * @Attribute(name="relative-y")
     * @var string
     */
    public $relativeY;
    
    /**
     * Fifths
     *
     * @Element
     * @var Fifths
     */
    public $fifths;

    /**
     * Mode
     *
     * @Element
     * @var Mode
     */
    public $mode;
    
    /**
     * Cancel
     *
     * @PropertyElement
     * @var Cancel
     */
    public $cancel;
    
    /**    
     * Key step
     *
     * @Element(name="key-step")
     * @var KeyStep
     */
    public $keyStep;

    /**
     * Key alter
     *
     * @Element(name="key-alter")
     * @var KeyAlter
     */
    public $keyAlter;

    /**
     * Key accidental
     *
     * @Element(name="key-accidental")
     * @var KeyAccidental
     */
    public $keyAccidental;

    /**
     * Key octave
     *
     * @Element(name="key-octave")
     * @var KeyOctave[]
     */
    public $keyOctave;
}