<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Tuplet
 * @Xml
 * @Path /path/measure/note/notation/tuplet
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/tuplet/
 * @Data
 */
class Tuplet extends MusicXMLWriter
{
    /**
     * Type
     *
     * @Attribute
     * @var string
     */
    public $type;
    
    /**
     * Bracket
     *
     * @Attribute
     * @var string
     */
    public $bracket;
    
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
     * ID
     *
     * @Attribute
     * @var string
     */
    public $id;
    
    /**
     * Line shape
     * 
     * @Attribute(name="line-shape)
     * @var string
     */
    public $lineShape;
    
    /**
     * Number
     *
     * @Attribute
     * @var string
     */
    public $number;
    
    /**
     * Placement
     *
     * @Attribute
     * @var string
     */
    public $placement;
    
    /**
     * Relative x
     * 
     * @Attribute(name="relative-x)
     * @var float
     */
    public $relativeX;
    
    /**
     * Relative y
     * 
     * @Attribute(name="relative-y)
     * @var float
     */
    public $relativeY;
    
    
    /**
     * Show number
     *
     * @Attribute(name="show-number")
     * @var string
     */
    public $showNumber;
    
    /**
     * Show type
     *
     * @Attribute(name="show-type")
     * @var string
     */
    public $showType;
    
    /**
     * Tuplet actual
     *
     * @Element
     * @var TupletActual
     */
    public $tupletActual;
    
    /**
     * Tuplet normal
     *
     * @Element
     * @var TupletNormal
     */
    public $tupletNormal;
}