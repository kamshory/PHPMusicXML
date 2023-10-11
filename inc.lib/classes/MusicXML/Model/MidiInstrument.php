<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * MidiInstrument
 * @Xml
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/midi-instrument/
 * @Data
 */
class MidiInstrument extends MusicXMLWriter
{
	/**
	 * Id
	 *
	 * @Attribute(name="id")
	 * @var string
	 */
	public $id;
    
	/*
	 * Midi channel
	 *
	 * @Element(name="midi-channel")
	 * @var MidiChannel
	 */
	public $midiChannel;

	/*
	 * Midi name
	 *
	 * @Element(name="midi-name")
	 * @var MidiName
	 */
	public $midiName;

	/*
	 * Midi bank
	 *
	 * @Element(name="midi-bank")
	 * @var MidiBank
	 */
	public $midiBank;

	/*
	 * Midi program
	 *
	 * @Element(name="midi-program")
	 * @var MidiProgram
	 */
	public $midiProgram;

	/*
	 * Midi unpitched
	 *
	 * @Element(name="midi-unpitched")
	 * @var MidiUnpitched
	 */
	public $midiUnpitched;

	/*
	 * Volume
	 *
	 * @Element(name="volume")
	 * @var Volume
	 */
	public $volume;

	/*
	 * Pan
	 *
	 * @Element(name="pan")
	 * @var Pan
	 */
	public $pan;

	/*
	 * Elevation
	 *
	 * @Element(name="elevation")
	 * @var Elevation
	 */
	public $elevation;


}