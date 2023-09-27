<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * MidiInstrument
 * @Xml
 * @Path /path-list/score-part/midi-instrument
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