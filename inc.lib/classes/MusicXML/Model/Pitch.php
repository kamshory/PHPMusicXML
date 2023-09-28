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
     * Step
     *
     * @PropertyElement
     * @var string
     */
    public $step;
    
    /**
     * Alter
     *
     * @PropertyElement
     * @var integer
     */
    public $alter;
    
    /**
     * Octave
     *
     * @PropertyElement
     * @var integer
     */
    public $octave;
}