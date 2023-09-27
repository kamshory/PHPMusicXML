<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Slur
 * Source https://github.com/talobin/MusicXML-Android/blob/master/parser/src/main/java/com/talobin/music/model/Slur.kt
 * @Xml
 * @Path /path/measure/note/notation/slur
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
}