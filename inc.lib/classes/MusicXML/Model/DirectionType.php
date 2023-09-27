<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Direction
 * @Xml
 * @Path /path/measure/direction/direction-type
 * @Data
 */
class DirectionType extends MusicXMLWriter
{
    /**
     * Metronome
     *
     * @Element
     * @var Metronome
     */
    public $metronom;
}