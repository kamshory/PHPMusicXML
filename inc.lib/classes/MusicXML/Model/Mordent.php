<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Mordent
 * @Xml
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/mordent/
 * @Data
 */
class Mordent extends MusicXMLWriter
{
	/**
	 * Accelerate
	 *
	 * @Attribute(name="accelerate")
	 * @var string
	 */
	public $accelerate;

	/**
	 * Approach
	 *
	 * @Attribute(name="approach")
	 * @var string
	 */
	public $approach;

	/**
	 * Beats
	 *
	 * @Attribute(name="beats")
	 * @var string
	 */
	public $beats;

	/**
	 * Color
	 *
	 * @Attribute(name="color")
	 * @var string
	 */
	public $color;

	/**
	 * Default x
	 *
	 * @Attribute(name="default-x")
	 * @var float
	 */
	public $defaultX;

	/**
	 * Default y
	 *
	 * @Attribute(name="default-y")
	 * @var float
	 */
	public $defaultY;

	/**
	 * Departure
	 *
	 * @Attribute(name="departure")
	 * @var string
	 */
	public $departure;

	/**
	 * Font family
	 *
	 * @Attribute(name="font-family")
	 * @var string
	 */
	public $fontFamily;

	/**
	 * Font size
	 *
	 * @Attribute(name="font-size")
	 * @var string
	 */
	public $fontSize;

	/**
	 * Font style
	 *
	 * @Attribute(name="font-style")
	 * @var string
	 */
	public $fontStyle;

	/**
	 * Font weight
	 *
	 * @Attribute(name="font-weight")
	 * @var string
	 */
	public $fontWeight;

	/**
	 * Last beat
	 *
	 * @Attribute(name="last-beat")
	 * @var string
	 */
	public $lastBeat;

	/**
	 * Long
	 *
	 * @Attribute(name="long")
	 * @var string
	 */
	public $long;

	/**
	 * Placement
	 *
	 * @Attribute(name="placement")
	 * @var string
	 */
	public $placement;

	/**
	 * Relative x
	 *
	 * @Attribute(name="relative-x")
	 * @var float
	 */
	public $relativeX;

	/**
	 * Relative y
	 *
	 * @Attribute(name="relative-y")
	 * @var float
	 */
	public $relativeY;

	/**
	 * Second beat
	 *
	 * @Attribute(name="second-beat")
	 * @var string
	 */
	public $secondBeat;

	/**
	 * Start note
	 *
	 * @Attribute(name="start-note")
	 * @var string
	 */
	public $startNote;

	/**
	 * Trill step
	 *
	 * @Attribute(name="trill-step")
	 * @var string
	 */
	public $trillStep;

	/**
	 * Two note turn
	 *
	 * @Attribute(name="two-note-turn")
	 * @var string
	 */
	public $twoNoteTurn;
    
}