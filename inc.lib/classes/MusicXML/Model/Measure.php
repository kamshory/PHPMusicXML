<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Measure
 * @Xml
 * @Path /path/measure
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/measure-partwise/
 * @Data
 */
class Measure extends MusicXMLWriter
{
    /**
     * Number
     *
     * @Attribute
     * @var string
     */
    public $number;
    
    /**
     * ID
     *
     * @Attribute
     * @var string
     */
    public $id;
    
    /**
     * Implicit
     *
     * @Attribute
     * @var string
     */
    public $implicit;
    
    /**
     * Non controlling
     *
     * @Attribute(name="non-controlling")
     * @var string
     */
    public $nonControlling;
    
    /**
     * Text
     * 
     * @Attribute
     * @var string
     */
    public $text;
    
    /**
     * Width
     * 
     * @Attribute
     * @var float
     */
    public $width;

    /**
     * Attribute list
     *
     * @Element(name="attributes")
     * @var Attributes
     */
    public $attributes;

    /**
     * Direction
     *
     * @Element
     * @var Direction[]
     */
    public $direction;
    
    /**
     * Note list
     *
     * @Element
     * @var Note[]
     */
    public $note;
    
    /**
     * Backup
     *
     * @Element
     * @var Backup[]
     */
    public $backup;
    
    /**
     * Grouping
     *
     * @Element(name="grouping")
     * @var Grouping[]
     */
    public $grouping;
    
    /**
     * Link
     *
     * @Element(name="link")
     * @var Link[]
     */
    public $link;
    
    /**
     * Bookmark
     *
     * @Element
     * @var Bookmark[]
     */
    public $bookmark;
    
}