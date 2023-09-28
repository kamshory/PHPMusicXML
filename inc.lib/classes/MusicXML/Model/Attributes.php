<?php

namespace MusicXML\Model;

namespace MusicXML\Model;

use DateTime;
use MusicXML\MusicXMLWriter;

/**
 * Attributes
 * Source https://github.com/talobin/MusicXML-Android/blob/master/parser/src/main/java/com/talobin/music/model/Attributes.kt
 * @Xml
 * @Path /path/measure/attribute
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
     * @var Key
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
}