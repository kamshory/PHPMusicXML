<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * WavyLine
 * @Xml
 * @MusicXML
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/wavy-line/
 * @Data
 */
class WavyLine extends MusicXMLWriter
{
	/**
	 * Type
	 *
	 * @Attribute(name="type")
	 * @var string
	 */
	public $type;

	/**
	 * Accelerate
	 *
	 * @Attribute(name="accelerate")
	 * @var string
	 */
	public $accelerate;

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
	 * Last beat
	 *
	 * @Attribute(name="last-beat")
	 * @var string
	 */
	public $lastBeat;

	/**
	 * Number
	 *
	 * @Attribute(name="number")
	 * @var string
	 */
	public $number;

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
	 * Smufl
	 *
	 * @Attribute(name="smufl")
	 * @var string
	 */
	public $smufl;

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