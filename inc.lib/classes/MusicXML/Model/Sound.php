<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Sound
 * @Xml
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/sound/
 * @Data
 */
class Sound extends MusicXMLWriter
{
	/**
	 * Coda
	 *
	 * @Attribute(name="coda")
	 * @var string
	 */
	public $coda;

	/**
	 * Dacapo
	 *
	 * @Attribute(name="dacapo")
	 * @var string
	 */
	public $dacapo;

	/**
	 * Dalsegno
	 *
	 * @Attribute(name="dalsegno")
	 * @var string
	 */
	public $dalsegno;

	/**
	 * Damper pedal
	 *
	 * @Attribute(name="damper-pedal")
	 * @var string
	 */
	public $damperPedal;

	/**
	 * Divisions
	 *
	 * @Attribute(name="divisions")
	 * @var string
	 */
	public $divisions;

	/**
	 * Dynamics
	 *
	 * @Attribute(name="dynamics")
	 * @var string
	 */
	public $dynamics;

	/**
	 * Elevation
	 *
	 * @Attribute(name="elevation")
	 * @var float
	 */
	public $elevation;

	/**
	 * Fine
	 *
	 * @Attribute(name="fine")
	 * @var string
	 */
	public $fine;

	/**
	 * Forward repeat
	 *
	 * @Attribute(name="forward-repeat")
	 * @var string
	 */
	public $forwardRepeat;

	/**
	 * Id
	 *
	 * @Attribute(name="id")
	 * @var string
	 */
	public $id;

	/**
	 * Pan
	 *
	 * @Attribute(name="pan")
	 * @var string
	 */
	public $pan;

	/**
	 * Pizzicato
	 *
	 * @Attribute(name="pizzicato")
	 * @var string
	 */
	public $pizzicato;

	/**
	 * Segno
	 *
	 * @Attribute(name="segno")
	 * @var string
	 */
	public $segno;

	/**
	 * Soft pedal
	 *
	 * @Attribute(name="soft-pedal")
	 * @var string
	 */
	public $softPedal;

	/**
	 * Sostenuto pedal
	 *
	 * @Attribute(name="sostenuto-pedal")
	 * @var string
	 */
	public $sostenutoPedal;

	/**
	 * Tempo
	 *
	 * @Attribute(name="tempo")
	 * @var integer
	 */
	public $tempo;

	/**
	 * Time only
	 *
	 * @Attribute(name="time-only")
	 * @var string
	 */
	public $timeOnly;

	/**
	 * Tocoda
	 *
	 * @Attribute(name="tocoda")
	 * @var string
	 */
	public $tocoda;

	/*
	 * Instrument change
	 *
	 * @Element(name="instrument-change")
	 * @var InstrumentChange[]
	 */
	public $instrumentChange;

	/*
	 * Midi device
	 *
	 * @Element(name="midi-device")
	 * @var MidiDevice[]
	 */
	public $midiDevice;

	/*
	 * Midi instrument
	 *
	 * @Element(name="midi-instrument")
	 * @var MidiInstrument[]
	 */
	public $midiInstrument;

	/*
	 * Play
	 *
	 * @Element(name="play")
	 * @var Play[]
	 */
	public $play;

	/*
	 * Swing
	 *
	 * @Element(name="swing")
	 * @var Swing
	 */
	public $swing;

	/*
	 * Offset
	 *
	 * @Element(name="offset")
	 * @var Offset
	 */
	public $offset;
	
	
}
