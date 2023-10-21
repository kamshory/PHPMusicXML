<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Ending
 * -
 * Ending is class of element &lt;ending&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;barline&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="ending")
 * @ParentElement(name="barline")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/ending/
 * @Data
 */
class Ending extends MusicXMLWriter
{
	/**
	 * Number
	 * -
	 * Indicates which times the ending is played, similar to the time-only attribute used by other elements. While this often represents the numeric values for what is under the ending line, it can also indicate whether an ending is played during a larger dal segno or da capo repeat. Single endings such as &quot;1&quot; or comma-separated multiple endings such as &quot;1,2&quot; may be used.
	 *
	 * @Attribute(name="number")
	 * @Value(type="ending-number" required="true", allowed="ANY_VALUE")
	 * @var string
	 */
	public $number;

	/**
	 * Type
	 * -
	 * Typically, the start type is associated with the left barline of the first measure in an ending. The stop and discontinue types are associated with the right barline of the last measure in an ending. Stop is used when the ending mark concludes with a downward jog, as is typical for first endings. Discontinue is used when there is no downward jog, as is typical for second endings that do not conclude a piece.
	 *
	 * @Attribute(name="type")
	 * @Value(type="start-stop-discontinue" required="true", allowed="start,stop,discontinue")
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
	 * End length
	 * -
	 * Specifies the length of the ending jog.
	 *
	 * @Attribute(name="end-length")
	 * @Value(type="tenths" required="false", min="-infinite", max="infinite")
	 * @var float
	 */
	public $endLength;

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
	 * System
	 * -
	 * Distinguishes elements that are associated with a system rather than the particular part where the element appears.
	 *
	 * @Attribute(name="system")
	 * @Value(type="system-relation" required="false", allowed="only-top,also-top,none")
	 * @var string
	 */
	public $system;

	/**
	 * Text x
	 * -
	 * An offset that specifies where the start of the ending text appears, relative to the start of the ending line.
	 *
	 * @Attribute(name="text-x")
	 * @Value(type="tenths" required="false", min="-infinite", max="infinite")
	 * @var float
	 */
	public $textX;

	/**
	 * Text y
	 * -
	 * An offset that specifies where the baseline of ending text appears, relative to the start of the ending line.
	 *
	 * @Attribute(name="text-y")
	 * @Value(type="tenths" required="false", min="-infinite", max="infinite")
	 * @var float
	 */
	public $textY;

	/**
	 * Text content
	 *
	 * @TextContent
	 * @var string
	 */
	public $textContent;
}