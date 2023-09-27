<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Time
 * Source https://github.com/talobin/MusicXML-Android/blob/master/parser/src/main/java/com/talobin/music/model/Time.kt
 * @Xml
 * @Path /path/measure/note/lyric
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/lyric/
 * @Data
 */
class Lyric extends MusicXMLWriter
{
    /**
     * Syllabic
     *
     * @PropertyElement
     * @var string
     */
    public $syllabic;
    
    /**
     * Text
     *
     * @PropertyElement
     * @var string
     */
    public $text;
}