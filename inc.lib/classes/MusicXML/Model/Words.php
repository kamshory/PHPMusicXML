<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Words
 * -
 * Words is class of element &lt;words&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;direction-type&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="words")
 * @ParentElement(name="direction-type")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/words/
 * @Data
 */
class Words extends MusicXMLWriter
{
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
	 * Dir
	 * -
	 * The text-direction attribute is used to adjust and override the Unicode bidirectional text algorithm, similar to the Directionality data category in the 
	 *
	 * @Attribute(name="dir")
	 * @Value(type="text-direction" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $dir;

	/**
	 * Enclosure
	 * -
	 * Formatting of an enclosure around text or symbols.
	 *
	 * @Attribute(name="enclosure")
	 * @Value(type="enclosure-shape" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $enclosure;

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
	 * Halign
	 * -
	 * In cases where text extends over more than one line, horizontal alignment and justify values can be different. The most typical case is for credits, such as:
	 *
	 * @Attribute(name="halign")
	 * @Value(type="left-center-right" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $halign;

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
	 * Justify
	 * -
	 * Indicates left, center, or right justification. The default value varies for different elements. For elements where the justify attribute is present but the halign attribute is not, the justify attribute indicates horizontal alignment as well as justification.
	 *
	 * @Attribute(name="justify")
	 * @Value(type="left-center-right" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $justify;

	/**
	 * Letter spacing
	 * -
	 * Specifies text tracking. Values are either normal, which allows flexibility of letter-spacing for purposes of text justification. or a number representing the number of ems to add between each letter. The number may be negative in order to subtract space. The value is normal if not specified.
	 *
	 * @Attribute(name="letter-spacing")
	 * @Value(type="number-or-normal" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $letterSpacing;

	/**
	 * Line height
	 * -
	 * Specifies text leading. Values are either normal or a number representing the percentage of the current font height to use for leading. It is normal if not specified. The exact normal value is implementation-dependent, but values between 100 and 120 are recommended.
	 *
	 * @Attribute(name="line-height")
	 * @Value(type="number-or-normal" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $lineHeight;

	/**
	 * Line through
	 * -
	 * Number of lines to use when striking through text.
	 *
	 * @Attribute(name="line-through")
	 * @Value(type="number-of-lines" required="false", min="-infinite", max="infinite")
	 * @var integer
	 */
	public $lineThrough;

	/**
	 * Overline
	 * -
	 * Number of lines to use when overlining text.
	 *
	 * @Attribute(name="overline")
	 * @Value(type="number-of-lines" required="false", min="-infinite", max="infinite")
	 * @var integer
	 */
	public $overline;

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
	 * Rotation
	 * -
	 * Used to rotate text around the alignment point specified by the halign and valign attributes. Positive values are clockwise rotations, while negative values are counter-clockwise rotations.
	 *
	 * @Attribute(name="rotation")
	 * @Value(type="rotation-degrees" required="false", min="-180", max="180")
	 * @var float
	 */
	public $rotation;

	/**
	 * Underline
	 * -
	 * Number of lines to use when underlining text.
	 *
	 * @Attribute(name="underline")
	 * @Value(type="number-of-lines" required="false", min="-infinite", max="infinite")
	 * @var integer
	 */
	public $underline;

	/**
	 * Valign
	 * -
	 * Indicates vertical alignment to the top, middle, bottom, or baseline of the text. The default is implementation-dependent.
	 *
	 * @Attribute(name="valign")
	 * @Value(type="valign" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $valign;

	/**
	 * Xml:lang
	 * -
	 * Specifies the language used in the element content. It is Italian (&quot;it&quot;) if not specified.
	 *
	 * @Attribute(name="xml:lang")
	 * @Value(type="xml:lang" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $xmlLang;

	/**
	 * Xml:space
	 * -
	 * Indicates whether white space should be preserved by applications.
	 *
	 * @Attribute(name="xml:space")
	 * @Value(type="xml:space" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $xmlSpace;

	/**
	 * Text content
	 *
	 * @TextContent
	 * @var string
	 */
	public $textContent;
}