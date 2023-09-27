<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Time
 * Source https://github.com/talobin/MusicXML-Android/blob/master/parser/src/main/java/com/talobin/music/model/Time.kt
 * @Xml
 * @Data
 */
class Time extends MusicXMLWriter
{
    /**
     * Beats
     *
     * @PropertyElement
     * @var string
     */
    public $beats;
    
    /**
     * Beat type
     *
     * @PropertyElement(name="beat-type")
     * @var string
     */
    public $beatType;
    
    /**
     * Symbol
     *
     * @PropertyElement
     * @var string
     */
    public $symbol;
}