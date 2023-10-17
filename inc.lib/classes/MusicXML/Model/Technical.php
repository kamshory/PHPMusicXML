<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Technical
 * -
 * Technical is class of element &lt;technical&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;notations&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="technical")
 * @ParentElement(name="notations")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/technical/
 * @Data
 */
class Technical extends MusicXMLWriter
{
	/**
	 * Id
	 * -
	 * Specifies an ID that is unique to the entire document.
	 *
	 * @Attribute(name="id")
	 * @Value(type="ID" required="false", allowed="ANY_VALUE")
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
	 * @var XString[]
	 */
	public $string;

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

	/**
	 * Tap
	 *
	 * @Element(name="tap")
	 * @var Tap[]
	 */
	public $tap;

	/**
	 * Heel
	 *
	 * @Element(name="heel")
	 * @var Heel[]
	 */
	public $heel;

	/**
	 * Toe
	 *
	 * @Element(name="toe")
	 * @var Toe[]
	 */
	public $toe;

	/**
	 * Fingernails
	 *
	 * @Element(name="fingernails")
	 * @var Fingernails[]
	 */
	public $fingernails;

	/**
	 * Hole
	 *
	 * @Element(name="hole")
	 * @var Hole[]
	 */
	public $hole;

	/**
	 * Arrow
	 *
	 * @Element(name="arrow")
	 * @var Arrow[]
	 */
	public $arrow;

	/**
	 * Handbell
	 *
	 * @Element(name="handbell")
	 * @var Handbell[]
	 */
	public $handbell;

	/**
	 * Bass bend
	 *
	 * @Element(name="brass-bend")
	 * @var BrassBend[]
	 */
	public $brassBend;

	/**
	 * Flip
	 *
	 * @Element(name="flip")
	 * @var Flip[]
	 */
	public $flip;

	/**
	 * Smear
	 *
	 * @Element(name="smear")
	 * @var Smear[]
	 */
	public $smear;

	/**
	 * Open
	 *
	 * @Element(name="open")
	 * @var Open[]
	 */
	public $open;

	/**
	 * Half muted
	 *
	 * @Element(name="half-muted")
	 * @var HalfMuted[]
	 */
	public $halfMuted;

	/**
	 * Harmon muted
	 *
	 * @Element(name="harmon-mute")
	 * @var HarmonMute[]
	 */
	public $harmonMute;

	/**
	 * Golpe
	 *
	 * @Element(name="golpe")
	 * @var Golpe[]
	 */
	public $golpe;

	/**
	 * Other technical
	 *
	 * @Element(name="other-technical")
	 * @var OtherTechnical[]
	 */
	public $otherTechnical;
}