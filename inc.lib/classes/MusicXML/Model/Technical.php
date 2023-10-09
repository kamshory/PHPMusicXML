<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Technical
 * @Xml
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/fret/
 * @Data
 */
class Technical extends MusicXMLWriter
{
	/**
	 * Id
	 *
	 * @Attribute(name="id")
	 * @var string
	 */
	public $id;

	/**
	 * Up bow
	 *
	 * @Element(name="up-bow")
	 * @var UpBow[]
	 */
	public $upBow;

	/**
	 * Down bow
	 *
	 * @Element(name="down-bow")
	 * @var DownBow[]
	 */
	public $downBow;

	/**
	 * Harmonic
	 *
	 * @Element(name="harmonic")
	 * @var Harmonic[]
	 */
	public $harmonic;

	/**
	 * Open string
	 *
	 * @Element(name="open-string")
	 * @var OpenString[]
	 */
	public $openString;

	/**
	 * Thumb position
	 *
	 * @Element(name="thumb-position")
	 * @var ThumbPosition[]
	 */
	public $thumbPosition;

	/**
	 * Fingering
	 *
	 * @Element(name="fingering")
	 * @var Fingering[]
	 */
	public $fingering;

	/**
	 * Pluck
	 *
	 * @Element(name="pluck")
	 * @var Pluck[]
	 */
	public $pluck;

	/**
	 * Double tongue
	 *
	 * @Element(name="double-tongue")
	 * @var DoubleTongue[]
	 */
	public $doubleTongue;
    
	/**
	 * Triple tongue
	 *
	 * @Element(name="triple-tongue")
	 * @var TripleTongue[]
	 */
	public $tripleTongue;


	/**
	 * Stopped
	 *
	 * @Element(name="stopped")
	 * @var Stopped[]
	 */
	public $stopped;

	/**
	 * Snap pizzicato
	 *
	 * @Element(name="snap-pizzicato")
	 * @var SnapPizzicato[]
	 */
	public $snapPizzicato;

	/**
	 * Fret
	 *
	 * @Element(name="fret")
	 * @var Fret[]
	 */
	public $fret;

	/**
	 * String
	 *
	 * @Element(name="string")
	 * @var MusicXMLString[]
	 */
	public $musicXMLString;

	/**
	 * Hummer on
	 *
	 * @Element(name="hammer-on")
	 * @var HammerOn[]
	 */
	public $hummerOn;

	/**
	 * Pull off
	 *
	 * @Element(name="pull-off")
	 * @var PullOff[]
	 */
	public $pullOff;

	/**
	 * Bend
	 *
	 * @Element(name="bend")
	 * @var Bend[]
	 */
	public $bend;
}
