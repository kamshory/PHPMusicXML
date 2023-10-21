<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Wedge
 * -
 * Wedge is class of element &lt;wedge&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;direction-type&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="wedge")
 * @ParentElement(name="direction-type")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/wedge/
 * @Data
 */
class Wedge extends MusicXMLWriter
{
	/**
	 * Type
	 * -
	 * The value is crescendo for the start of a wedge that is closed at the left side, diminuendo for the start of a wedge that is closed on the right side, and stop for the end of a wedge.
	 *
	 * @Attribute(name="type")
	 * @Value(type="wedge-type" required="true", allowed="ANY_VALUE")
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
	 * Dash length
	 * -
	 * The length of dashes in a dashed line. Ignored if the corresponding line-type attribute is not dashed.
	 *
	 * @Attribute(name="dash-length")
	 * @Value(type="tenths" required="false", min="-infinite", max="infinite")
	 * @var float
	 */
	public $dashLength;

	/**
	 * Default x
	 * -
	 * Changes the computation of the default horizontal position. The origin is changed relative to the start of the entire current measure, at either the left barline or the start of the system. Positive x is right and negative x is left.
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
	 * Line type
	 * -
	 * Specifies if the line is solid, dashed, dotted, or wavy.
	 *
	 * @Attribute(name="line-type")
	 * @Value(type="line-type" required="false", allowed="dashed,dotted,solid,wavy")
	 * @var string
	 */
	public $lineType;

	/**
	 * Niente
	 * -
	 * A value is yes indicates that a circle appears at the point of the wedge, indicating a crescendo from nothing or diminuendo to nothing. It is no if not specified, and used only when the type is crescendo, or the type is stop for a wedge that began with a diminuendo type.
	 *
	 * @Attribute(name="niente")
	 * @Value(type="yes-no" required="false", allowed="yes,no")
	 * @var string
	 */
	public $niente;

	/**
	 * Number
	 * -
	 * Distinguishes multiple wedges when they overlap in MusicXML document order.
	 *
	 * @Attribute(name="number")
	 * @Value(type="number-level" required="false", min="-infinite", max="infinite")
	 * @var integer
	 */
	public $number;

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
	 * Space length
	 * -
	 * The length of spaces in a dashed line. Ignored if the corresponding line-type attribute is not dashed.
	 *
	 * @Attribute(name="space-length")
	 * @Value(type="tenths" required="false", min="-infinite", max="infinite")
	 * @var float
	 */
	public $spaceLength;

	/**
	 * Spread
	 * -
	 * Indicates the gap between the top and bottom of the wedge as measured in tenths. Ignored if specified at the start of a crescendo wedge or the end of a diminuendo wedge.
	 *
	 * @Attribute(name="spread")
	 * @Value(type="tenths" required="false", min="-infinite", max="infinite")
	 * @var float
	 */
	public $spread;

}