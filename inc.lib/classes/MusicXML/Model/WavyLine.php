<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * WavyLine
 * -
 * WavyLine is class of element &lt;wavy-line&gt; Open link at &#64;Referece to read full documentation.
 * Parent elements: &lt;barline&gt;, &lt;ornaments&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="wavy-line")
 * @ParentElement(name="barline,ornaments")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/wavy-line/
 * @Data
 */
class WavyLine extends MusicXMLWriter
{
	/**
	 * Type
	 * -
	 * Indicates if this is the start, stop, or continuation of the wavy line. The value should be continue whenever used within a &lt;barline&gt; element.
	 *
	 * @Attribute(name="type")
	 * @Value(type="start-stop-continue" required="true", allowed="start,stop,continue")
	 * @var string
	 */
	public $type;

	/**
	 * Accelerate
	 * -
	 * If yes, the trill accelerates during playback. It is no if not specified.
	 *
	 * @Attribute(name="accelerate")
	 * @Value(type="yes-no" required="false", allowed="yes,no")
	 * @var string
	 */
	public $accelerate;

	/**
	 * Beats
	 * -
	 * The number of distinct notes during playback, counting the starting note but not the two-note turn. It is 4 if not specified.
	 *
	 * @Attribute(name="beats")
	 * @Value(type="trill-beats" required="false", min="-infinite", max="infinite")
	 * @var integer
	 */
	public $beats;

	/**
	 * Color
	 * -
	 * Indicates the color of an element.
	 *
	 * @Attribute(name="color")
	 * @Value(type="color" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $color;

	/**
	 * Default x
	 * -
	 * Changes the computation of the default horizontal position. The origin is changed relative to the left-hand side of the note or the musical position within the bar. Positive x is right and negative x is left.
	 *
	 * @Attribute(name="default-x")
	 * @Value(type="tenths" required="false", min="-infinite", max="infinite")
	 * @var float
	 */
	public $defaultX;

	/**
	 * Default y
	 * -
	 * Changes the computation of the default vertical position. The origin is changed relative to the top line of the staff. Positive y is up and negative y is down.
	 *
	 * @Attribute(name="default-y")
	 * @Value(type="tenths" required="false", min="-infinite", max="infinite")
	 * @var float
	 */
	public $defaultY;

	/**
	 * Last beat
	 * -
	 * The percentage of the way through the duration for landing on the last beat. It is 75 if not specified.
	 *
	 * @Attribute(name="last-beat")
	 * @Value(type="percent" required="false", min="0", max="100")
	 * @var float
	 */
	public $lastBeat;

	/**
	 * Number
	 * -
	 * Distinguishes multiple wavy lines when they overlap in MusicXML document order.
	 *
	 * @Attribute(name="number")
	 * @Value(type="number-level" required="false", min="-infinite", max="infinite")
	 * @var integer
	 */
	public $number;

	/**
	 * Placement
	 * -
	 * Indicates whether something is above or below another element, such as a note or a notation.
	 *
	 * @Attribute(name="placement")
	 * @Value(type="above-below" required="false", allowed="ubove,below")
	 * @var string
	 */
	public $placement;

	/**
	 * Relative x
	 * -
	 * Changes the horizontal position relative to the default position, either as computed by the individual program, or as overridden by the default-x attribute.  Positive x is right and negative x is left. It should be interpreted in the context of the &lt;offset&gt; element or directive attribute if those are present.
	 *
	 * @Attribute(name="relative-x")
	 * @Value(type="tenths" required="false", min="-infinite", max="infinite")
	 * @var float
	 */
	public $relativeX;

	/**
	 * Relative y
	 * -
	 * Changes the vertical position relative to the default position, either as computed by the individual program, or as overridden by the default-y attribute. Positive y is up and negative y is down. It should be interpreted in the context of the placement attribute if that is present.
	 *
	 * @Attribute(name="relative-y")
	 * @Value(type="tenths" required="false", min="-infinite", max="infinite")
	 * @var float
	 */
	public $relativeY;

	/**
	 * Second beat
	 * -
	 * The percentage of the way through the duration for landing on the second beat. It is 25 if not specified.
	 *
	 * @Attribute(name="second-beat")
	 * @Value(type="percent" required="false", min="0", max="100")
	 * @var float
	 */
	public $secondBeat;

	/**
	 * Smufl
	 * -
	 * Specifies a particular wavy line glyph from the Standard Music Font Layout (SMuFL) 
	 *
	 * @Attribute(name="smufl")
	 * @Value(type="smufl-wavy-line-glyph-name" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $smufl;

	/**
	 * Start note
	 * -
	 * The starting note for playback, relative to the current note. It is upper if not specified.
	 *
	 * @Attribute(name="start-note")
	 * @Value(type="start-note" required="false", allowed="below,main,upper")
	 * @var string
	 */
	public $startNote;

	/**
	 * Trill step
	 * -
	 * The alternating note for playback, relative to the current note. It is whole if not specified.
	 *
	 * @Attribute(name="trill-step")
	 * @Value(type="trill-step" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $trillStep;

	/**
	 * Two note turn
	 * -
	 * Specifies the two-note turn included at the end of the trill, if any. It is none if not specified.
	 *
	 * @Attribute(name="two-note-turn")
	 * @Value(type="two-note-turn" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $twoNoteTurn;

}