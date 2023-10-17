<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Slur
 * -
 * Slur is class of element &lt;slur&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;notations&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="slur")
 * @ParentElement(name="notations")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/slur/
 * @Data
 */
class Slur extends MusicXMLWriter
{
	/**
	 * Type
	 * -
	 * Indicates if this is the start, stop, or continuation of the slur.
	 *
	 * @Attribute(name="type")
	 * @Value(type="start-stop-continue" required="true", allowed="start,stop,continue")
	 * @var string
	 */
	public $type;

	/**
	 * Bezier offset
	 * -
	 * The horizontal position of an outgoing bezier point for slurs and ties with a start type, or of an incoming bezier point for slurs and ties with types of stop or continue. If both the bezier-x and bezier-offset attributes are present, the bezier-x attribute takes priority. This attribute is deprecated as of MusicXML 3.1.
	 *
	 * @Attribute(name="bezier-offset")
	 * @Value(type="divisions" required="false", min="-infinite", max="infinite")
	 * @var float
	 */
	public $bezierOffset;

	/**
	 * Bezier offset2
	 * -
	 * The horizontal position of an outgoing bezier point for slurs with a continue type. Not valid for other types. If both the bezier-x2 and bezier-offset2 attributes are present, the bezier-x2 attribute takes priority. This attribute is deprecated as of MusicXML 3.1.
	 *
	 * @Attribute(name="bezier-offset2")
	 * @Value(type="divisions" required="false", min="-infinite", max="infinite")
	 * @var float
	 */
	public $bezierOffset2;

	/**
	 * Bezier x
	 * -
	 * The horizontal position of an outgoing bezier point for slurs and ties with a start type, or of an incoming bezier point for slurs and ties with types of stop or continue.
	 *
	 * @Attribute(name="bezier-x")
	 * @Value(type="tenths" required="false", min="-infinite", max="infinite")
	 * @var float
	 */
	public $bezierX;

	/**
	 * Bezier x2
	 * -
	 * The horizontal position of an outgoing bezier point for slurs with a continue type. Not valid for other types.
	 *
	 * @Attribute(name="bezier-x2")
	 * @Value(type="tenths" required="false", min="-infinite", max="infinite")
	 * @var float
	 */
	public $bezierX2;

	/**
	 * Bezier y
	 * -
	 * The vertical position of an outgoing bezier point for slurs and ties with a start type, or of an incoming bezier point for slurs and ties with types of stop or continue.
	 *
	 * @Attribute(name="bezier-y")
	 * @Value(type="tenths" required="false", min="-infinite", max="infinite")
	 * @var float
	 */
	public $bezierY;

	/**
	 * Bezier y2
	 * -
	 * The vertical position of an outgoing bezier point for slurs with a continue type. Not valid for other types.
	 *
	 * @Attribute(name="bezier-y2")
	 * @Value(type="tenths" required="false", min="-infinite", max="infinite")
	 * @var float
	 */
	public $bezierY2;

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
	 * Number
	 * -
	 * Distinguishes multiple slurs when they overlap in MusicXML document order.
	 *
	 * @Attribute(name="number")
	 * @Value(type="number-level" required="false", min="-infinite", max="infinite")
	 * @var integer
	 */
	public $number;

	/**
	 * Orientation
	 * -
	 * Indicates whether slurs and ties are overhand (tips down) or underhand (tips up). This is distinct from the placement attribute used by any notation type.
	 *
	 * @Attribute(name="orientation")
	 * @Value(type="over-under" required="false", allowed="over,under")
	 * @var string
	 */
	public $orientation;

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
	 * Space length
	 * -
	 * The length of spaces in a dashed line. Ignored if the corresponding line-type attribute is not dashed.
	 *
	 * @Attribute(name="space-length")
	 * @Value(type="tenths" required="false", min="-infinite", max="infinite")
	 * @var float
	 */
	public $spaceLength;

}