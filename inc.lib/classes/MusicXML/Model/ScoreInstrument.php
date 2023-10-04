<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * ScoreInstrument
 * @Xml
 * @Path /path-list/score-part/score-instrument
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/score-instrument/
 * @Data
 */
class ScoreInstrument extends MusicXMLWriter
{
    /**
     * ID
     *
     * @Attribute
     * @var string
     */
    public $id;
    
    /**
     * Instrument name
     *
     * @PropertyElement(name="instrument-name")
     * @var string
     */
    public $instrumentName;
    
    /**
     * Instrument name
     *
     * @PropertyElement(name="instrument-sound")
     * @var string
     */
    public $instrumentSound;
    
    
}