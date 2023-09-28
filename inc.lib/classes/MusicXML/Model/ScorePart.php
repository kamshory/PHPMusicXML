<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * ScorePart
 * Source https://github.com/talobin/MusicXML-Android/blob/master/parser/src/main/java/com/talobin/music/model/ScorePart.kt
 * @Xml
 * @Path /path-list/score-part
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
     * @var ScoreInstrument[]
     */
    public $scoreInstrument;
    
    /**
     * Midi device
     *
     * @Element(name="midi-device")
     * @var MidiDevice
     */
    public $midiDevice;
    
    /**
     * Midi instrument
     *
     * @Element(name="midi-instrument")
     * @var MidiInstrument[]
     */
    public $midiInstrument;
}