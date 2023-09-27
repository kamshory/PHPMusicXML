<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * ScorePart
 * Source https://github.com/talobin/MusicXML-Android/blob/master/parser/src/main/java/com/talobin/music/model/ScorePart.kt
 * @Xml
 * @Data
 */
class ScorePart extends MusicXMLWriter
{
    /**
     * ID
     *
     * @Attribute
     * @var string
     */
    public $id;
    
    /**
     * Part name
     *
     * @PropertyElement(name="part-name")
     * @var string
     */
    public $partName;
    
    /**
     * Part abbreviation
     *
     * @PropertyElement(name="part-abbreviation")
     * @var string
     */
    public $partAbbreviation;
    
    /**
     * Score instrument
     *
     * @Element(name="score-instrument")
     * @var ScoreInstrument
     */
    public $scoreInstrument;
    
    /**
     * Midi instrument
     *
     * @Element(name="score-instrument")
     * @var MidiInstrument
     */
    public $midiInstrument;
}