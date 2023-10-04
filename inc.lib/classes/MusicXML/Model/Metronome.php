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
     * Parentheses
     *
     * @Attribute
     * @var string
     */
    public $parentheses;

    /**
     * Direction type
     *
     * @PropertyElement(name="direction-type")
     * @var DirectionType
     */
    public $directionType;

    /**
     * Beat unit
     *
     * @PropertyElement(name="beat-unit")
     * @var string
     */
    public $beatUnit;
    
    /**
     * Per minute
     *
     * @PropertyElement(name="per-minute")
     * @var integer
     */
    public $perMinute;
}