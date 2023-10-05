<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Lyric
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
    public $textContent;
}