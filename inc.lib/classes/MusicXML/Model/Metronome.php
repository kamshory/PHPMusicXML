<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Metronome
 * @Xml
 * @Data
 */
class Metronome extends MusicXMLWriter
{

    /**
     * Beat unit
     *
     * @PropertyElement(name="beat-unit")
     * @var string
     */
    public $directionType;
    
    /**
     * Per minute
     *
     * @PropertyElement(name="per-minute")
     * @var integer
     */
    public $perMinute;
}