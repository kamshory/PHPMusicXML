<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Slur
 * @Xml
 * @MusicXML
 * @Path /path/measure/note/notation/slur
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/slur/
 * @Data
 */
class Slur extends MusicXMLWriter
{
    /**
     * Number
     *
     * @Attribute
     * @var string
     */
    public $number;
    
    /**
     * Orientation
     *
     * @Attribute
     * @var string
     */
    public $orientation;
    
    /**
     * Type
     *
     * @Attribute
     * @var string
     */
    public $type;
    
    /**
     * Bezier offset
     * 
     * @Attribute(name="bezier-offset)
     * @var integer
     */
    public $bezierOffset;
    
    /**
     * Bezier offset 2
     * 
     * @Attribute(name="bezier-offset2)
     * @var integer
     */
    public $bezierOffset2;
    
    /**
     * Bezier x
     * 
     * @Attribute(name="bezier-x)
     * @var float
     */
    public $bezierX;
    
    /**
     * Bezier x2
     * 
     * @Attribute(name="bezier-x2)
     * @var float
     */
    public $bezierX2;
    
    /**
     * Bezier y
     * 
     * @Attribute(name="bezier-y)
     * @var float
     */
    public $bezierY;
    
    /**
     * Bezier y2
     * 
     * @Attribute(name="bezier-y2)
     * @var float
     */
    public $bezierY2;
    
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
     * @Attribute(name="dash-length)
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
    
}