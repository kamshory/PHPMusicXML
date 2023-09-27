<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Pitch
 * Source https://github.com/talobin/MusicXML-Android/blob/master/parser/src/main/java/com/talobin/music/model/Pitch.kt
 * @Xml
 * @Path /path/measure/note/pitch
 * @Data
 */
class Pitch extends MusicXMLWriter
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