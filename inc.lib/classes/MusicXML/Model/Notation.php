<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Notation
 * Source https://github.com/talobin/MusicXML-Android/blob/master/parser/src/main/java/com/talobin/music/model/Notation.kt
 * @Xml
 * @Path /path/measure/note/notation
 * @Data
 */
class Notation extends MusicXMLWriter
{
    /**
     * Tied list
     *
     * @Element(name="tied")
     * @var Tied[]
     */
    public $tiedList;
    
    /**
     * Slur list
     *
     * @Element(name="slur")
     * @var Slur[]
     */
    public $slurList;
    
    /**
     * Articulations
     *
     * @Element
     * @var Articulations
     */
    public $articulations;
}