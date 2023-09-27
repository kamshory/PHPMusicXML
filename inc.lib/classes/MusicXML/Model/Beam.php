<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Beam
 * Source https://github.com/talobin/MusicXML-Android/blob/master/parser/src/main/java/com/talobin/music/model/Beam.kt
 * @Xml
 * @Data
 */
class Beam extends MusicXMLWriter
{
    /**
     * Number
     * @Attribute
     * @var string
     */
    public $number;
    /**
     * Description
     * @TextContent
     * @var string
     */
    public $description;
}