<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Clef
 * @Xml
 * @Path /path/measure/attribute/clef
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/clef/
 * @Data
 */
class Clef extends MusicXMLWriter
{
    /**
     * Number
     * @Attribute
     * @var string
     */
    public $number;
    
    /**
     * Description
     * @PropertyElement
     * @var string
     */
    public $sign;
    
    /**
     * Line
     * @Element
     * @var Line
     */
    public $line;
}