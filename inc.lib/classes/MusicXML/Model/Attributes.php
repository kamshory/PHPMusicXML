<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Attributes
 * @Xml
 * @Path /path/measure/attributes
 * @Referece https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/attributes/
 * @Data
 */
class Attributes extends MusicXMLWriter
{
    
    /**
     * Division
     * @PropertyElement
     * @var string
     */
    public $divisions;
    
    /**
     * Key
     * @Element
     * @var Key[]
     */
    public $key;

    /**
     * Time
     * @Element
     * @var Time
     */
    public $time;

    /**
     * Staves
     * @PropertyElement
     * @var string
     */
    public $staves;

    /**
     * Clef
     * @Element
     * @var Clef[]
     */
    public $clef;
    
    /**
     * Transpose
     * @Element
     * @var Transpose
     */
    public $transpose;
    
    /**
     * Footnote
     * 
     * @Element
     * @var Footnote
     */
    public $footnote;
    
    /**
     * Level
     * 
     * @Element
     * @var Level
     */
    public $level;
}