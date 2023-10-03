<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Metronome
 * @Xml
 * @Path /path/measure/direction/direction-type/metronome
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/metronome/
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