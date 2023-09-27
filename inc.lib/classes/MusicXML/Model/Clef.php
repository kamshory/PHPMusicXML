<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Clef
 * Source https://github.com/talobin/MusicXML-Android/blob/master/parser/src/main/java/com/talobin/music/model/Clef.kt
 * @Xml
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
     * @PropertyElement
     * @var string
     */
    public $line;
}