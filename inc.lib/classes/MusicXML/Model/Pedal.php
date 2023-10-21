<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Pedal
 * -
 * Pedal is class of element &lt;pedal&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;direction-type&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="pedal")
 * @ParentElement(name="direction-type")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/pedal/
 * @Data
 */
class Pedal extends MusicXMLWriter
{
	/**
	 * Type
	 * -
	 * Distinguishes different types of pedal directions.
	 *
	 * @Attribute(name="type")
	 * @Value(type="pedal-type" required="true", allowed="start,stop,sostenuto,change,continue,discontinue,resume")
	 * @var string
	 */
	public $type;

	/**
	 * Abbreviated
	 * -
	 * Used only when the sign attribute is yes and the type is start or sostenuto; otherwise it is ignored. If yes, the short P and S signs are used. If no, the full Ped and Sost signs are used. It is no if not specified.
	 *
	 * @Attribute(name="abbreviated")
	 * @Value(type="yes-no" required="false", allowed="yes,no")
	 * @var string
	 */
	public $abbreviated;

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
	 * Line
	 * -
	 * If yes, then pedal lines are used.
	 *
	 * @Attribute(name="line")
	 * @Value(type="yes-no" required="false", allowed="yes,no")
	 * @var string
	 */
	public $line;

	/**
	 * Number
	 * -
	 * Distinguishes multiple pedals when they overlap in MusicXML document order.
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
	 * Sign
	 * -
	 * If yes, then Ped, Sost, and * signs are used. For compatibility with older versions, it is yes if not specified if the line attribute is no, and is no if not specified if the line attribute is yes. If no, the alignment attributes are ignored.
	 *
	 * @Attribute(name="sign")
	 * @Value(type="yes-no" required="false", allowed="yes,no")
	 * @var string
	 */
	public $sign;

}