<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * HammerOn
 * -
 * HammerOn is class of element &lt;hammer-on&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;technical&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="hammer-on")
 * @ParentElement(name="technical")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/hammer-on/
 * @Data
 */
class HammerOn extends MusicXMLWriter
{
	/**
	 * Type
	 * -
	 * Indicates if this is the start or stop of the hammer-on.
	 *
	 * @Attribute(name="type")
	 * @Value(type="start-stop" required="true", allowed="ANY_VALUE")
	 * @var string
	 */
	public $type;

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
	 * Number
	 * -
	 * Distinguishes multiple hammer-ons when they overlap in MusicXML document order. The default value is 1.
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
	 * @Value(type="above-below" required="false", allowed="ANY_VALUE")
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
	 * Text content
	 *
	 * @TextContent
	 * @var string
	 */
	public $textContent;

}