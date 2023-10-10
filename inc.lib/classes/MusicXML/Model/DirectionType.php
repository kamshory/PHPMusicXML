<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * DirectionType
 * @Xml
 * @Path /path/measure/direction/direction-type
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/direction-type/
 * @Data
 */
class DirectionType extends MusicXMLWriter
{
    /**
     * ID
     *
     * @Attribute(name="id")
     * @var string
     */
    public $id;
    
    /**
     * Metronome
     *
     * @Element
     * @var Metronome
     */
    public $metronome;
}