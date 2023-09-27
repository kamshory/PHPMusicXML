<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Tied
 * Source https://github.com/talobin/MusicXML-Android/blob/master/parser/src/main/java/com/talobin/music/model/Tied.kt
 * @Xml
 * @Path /path/measure/note/notation/tied
 * @Data
 */
class Tied extends MusicXMLWriter
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