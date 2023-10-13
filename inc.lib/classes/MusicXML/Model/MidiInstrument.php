<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * MidiInstrument
 * -
 * MidiInstrument is class of element &lt;midi-instrument&gt; Open link at &#64;Referece to read full documentation.
 * Parent elements: &lt;score-part&gt;, &lt;sound&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="midi-instrument")
 * @ParentElement(name="score-part,sound")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/midi-instrument/
 * @Data
 */
class MidiInstrument extends MusicXMLWriter
{
	/**
	 * Id
	 * -
	 * Refers to the &lt;score-instrument&gt; element affected by the change.
	 *
	 * @Attribute(name="id")
	 * @Value(type="IDREF" required="true", allowed="ANY_VALUE")
	 * @var string
	 */
	public $id;

	/**
	 * Midi channel
	 *
	 * @Element(name="midi-channel")
	 * @var MidiChannel
	 */
	public $midiChannel;

	/**
	 * Midi name
	 *
	 * @Element(name="midi-name")
	 * @var MidiName
	 */
	public $midiName;

	/**
	 * Midi bank
	 *
	 * @Element(name="midi-bank")
	 * @var MidiBank
	 */
	public $midiBank;

	/**
	 * Midi program
	 *
	 * @Element(name="midi-program")
	 * @var MidiProgram
	 */
	public $midiProgram;

	/**
	 * Midi unpitched
	 *
	 * @Element(name="midi-unpitched")
	 * @var MidiUnpitched
	 */
	public $midiUnpitched;

	/**
	 * Volume
	 *
	 * @Element(name="volume")
	 * @var Volume
	 */
	public $volume;

	/**
	 * Pan
	 *
	 * @Element(name="pan")
	 * @var Pan
	 */
	public $pan;

	/**
	 * Elevation
	 *
	 * @Element(name="elevation")
	 * @var Elevation
	 */
	public $elevation;

}