<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Articulations
 * Source https://github.com/talobin/MusicXML-Android/blob/master/parser/src/main/java/com/talobin/music/model/Articulations.kt
 * @Xml
 * @Data
 */
class Articulations extends MusicXMLWriter
{
    /**
     * @PropertyElement 
     * @var string
     */
    public $staccato;
}