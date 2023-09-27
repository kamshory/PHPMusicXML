<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Measure
 * Source https://github.com/talobin/MusicXML-Android/blob/master/parser/src/main/java/com/talobin/music/model/Measure.kt
 * @Xml
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
     * Width
     * 
     * @Attribute
     * @var string
     */
    public $width;
    
    /**
     * Note list
     *
     * @Element(name="note")
     * @var Note[]
     */
    public $noteList;
    
    /**
     * Attribute list
     *
     * @Element(name="attributes")
     * @var Attributes[]
     */
    public $attributesList;
}