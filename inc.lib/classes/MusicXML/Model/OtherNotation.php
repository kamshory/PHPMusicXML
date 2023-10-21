<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * OtherNotation
 * -
 * OtherNotation is class of element &lt;other-notation&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;notations&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="other-notation")
 * @ParentElement(name="notations")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/other-notation/
 * @Data
 */
class OtherNotation extends MusicXMLWriter
{
	/**
	 * Type
	 * -
	 * Indicates if this is a single-note notation, or the start or stop of a multi-note notation.
	 *
	 * @Attribute(name="type")
	 * @Value(type="start-stop-single" required="true", allowed="start,stop,single")
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
	 * Number
	 * -
	 * Distinguishes multiple notations when they overlap in MusicXML document order. The default value is 1.
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
	 * Print object
	 * -
	 * Specifies whether or not to print an object. It is yes if not specified.
	 *
	 * @Attribute(name="print-object")
	 * @Value(type="yes-no" required="false", allowed="yes,no")
	 * @var string
	 */
	public $printObject;

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
	 * Smufl
	 * -
	 * Indicates a particular Standard Music Font Layout (SMuFL) character using its canonical glyph name. Sometimes this is a formatting choice, and sometimes this is a refinement of the semantic meaning of an element.
	 *
	 * @Attribute(name="smufl")
	 * @Value(type="smufl-glyph-name" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $smufl;

	/**
	 * Text content
	 *
	 * @TextContect
	 * @var string
	 */
	public $textContent;

}