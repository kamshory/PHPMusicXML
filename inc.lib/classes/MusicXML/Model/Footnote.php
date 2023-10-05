<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Footnote
 * @Xml
 * @Referece https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/footnote/
 * @Data
 */
class Footnote extends MusicXMLWriter
{
    /**
     * @Attribute 
     * @var string
     */
    public $staccato;
    
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
     * Direction
     * 
     * @Attribute
     * @var string
     */
    public $dir;
    
    /**
     * Enclosure
     * 
     * @Attribute
     * @var string
     */
    public $enclosure;
    
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
     * Horizontal alignment
     * 
     * @Attribute
     * @var string
     */
    public $halign;
    
    /**
     * Justify
     * 
     * @Attribute
     * @var string
     */
    public $justify;
    
    /**
     * Letter spacing
     * 
     * @Attribute(name="letter-spacing")
     * @var string
     */
    public $letterSpacing;
    
    /**
     * Line height
     * 
     * @Attribute(name="line-height")
     * @var string
     */
    public $lineHeight;
    
    /**
     * Line through
     * 
     * @Attribute(name="line-through")
     * @var string
     */
    public $lineThrough;
    
    /**
     * Overline
     * 
     * @Attribute
     * @var string
     */
    public $overline;
    
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
    public $relativeX;
    
    /**
     * Rotation
     * 
     * @Attribute
     * @var string
     */
    public $rotation;
    
    /**
     * Underline
     * 
     * @Attribute
     * @var string
     */
    public $underline;
    
    /**
     * Vertical alignment
     * 
     * @Attribute
     * @var string
     */
    public $valign;
    
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
    
}

