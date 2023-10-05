<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Directive
 * @Xml
 * @Referece https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/directive/
 * @Data
 */
class Directive extends MusicXMLWriter
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
     * XML Language
     * 
     * @Attribute(name="xml:lang")
     * @var string
     */
    public $xmlLang;
    
    /**
     * XML Space
     * 
     * @Attribute(name="xml:space")
     * @var string
     */
    public $xmlSpace;
    
    /**
     * Description
     *
     * @TextContent
     * @var string
     */
    public $textContent;

}

