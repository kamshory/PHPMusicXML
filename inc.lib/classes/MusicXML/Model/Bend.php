<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Bend
 * -
 * Bend is class of element &lt;bend&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;technical&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="bend")
 * @ParentElement(name="technical")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/bend/
 * @Data
 */
class Bend extends MusicXMLWriter
{
	/**
	 * Accelerate
	 * -
	 * Does the bend accelerate during playback? Default is &quot;no&quot;.
	 *
	 * @Attribute(name="accelerate")
	 * @Value(type="yes-no" required="false", allowed="yes,no")
	 * @var string
	 */
	public $accelerate;

	/**
	 * Beats
	 * -
	 * The number of discrete elements (like MIDI pitch bends) used to represent a continuous bend or slide. Default is 4.
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
	 * First beat
	 * -
	 * The percentage of the duration for starting a bend. Default is 25.
	 *
	 * @Attribute(name="first-beat")
	 * @Value(type="percent" required="false", min="0", max="100")
	 * @var float
	 */
	public $firstBeat;

	/**
	 * Font family
	 * -
	 * A comma-separated list of font names.
	 *
	 * @Attribute(name="font-family")
	 * @Value(type="font-family" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $fontFamily;

	/**
	 * Font size
	 * -
	 * One of the CSS sizes or a numeric point size.
	 *
	 * @Attribute(name="font-size")
	 * @Value(type="font-size" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $fontSize;

	/**
	 * Font style
	 * -
	 * Normal or italic style.
	 *
	 * @Attribute(name="font-style")
	 * @Value(type="font-style" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $fontStyle;

	/**
	 * Font weight
	 * -
	 * Normal or bold weight.
	 *
	 * @Attribute(name="font-weight")
	 * @Value(type="font-weight" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $fontWeight;

	/**
	 * Last beat
	 * -
	 * The percentage of the duration for ending a bend. Default is 75.
	 *
	 * @Attribute(name="last-beat")
	 * @Value(type="percent" required="false", min="0", max="100")
	 * @var float
	 */
	public $lastBeat;

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
	 * Shape
	 * -
	 * Distinguishes between the angled bend symbols commonly used in standard notation and the curved bend symbols commonly used in both tablature and standard notation.
	 *
	 * @Attribute(name="shape")
	 * @Value(type="bend-shape" required="false", allowed="angled,curved")
	 * @var string
	 */
	public $shape;

	/**
	 * Bend alter
	 *
	 * @Element(name="bend-alter")
	 * @var BendAlter
	 */
	public $bendAlter;

	/**
	 * Pre bend
	 *
	 * @Element(name="pre-bend")
	 * @var PreBend[]
	 */
	public $preBend;

	/**
	 * Release
	 *
	 * @Element(name="release")
	 * @var Release[]
	 */
	public $release;

	/**
	 * With bar
	 *
	 * @Element(name="with-bar")
	 * @var WithBar
	 */
	public $withBar;
}