<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * MidiInstrument
 * @Xml
 * @Path /path-list/score-part/midi-instrument
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/midi-instrument/
 * @Data
 */
class MidiInstrument extends MusicXMLWriter
{
    /**
     * ID
     *
     * @Attribute
     * @var string
     */
    public $id;
    
    /**
     * MIDI hannel
     *
     * @PropertyElement(name="midi-channel")
     * @var string
     */
    public $midiChannel;
    
    /**
     * MIDI program
     *
     * @PropertyElement(name="midi-program")
     * @var string
     */
    public $midiProgram;

    /**
     * MIDI unpitched
     *
     * @PropertyElement(name="midi-unpitched")
     * @var integer
     */
    public $midiUnpitched;
    
    /**
     * Volume
     *
     * @PropertyElement
     * @var float
     */
    public $volume = 0;
    
    /**
     * Pan
     *
     * @PropertyElement
     * @var float
     */
    public $pan = 0;
    
    
    
    
}