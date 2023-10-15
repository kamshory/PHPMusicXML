<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Notehead
 * -
 * Notehead is class of element &lt;notehead&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;note&gt;
 * 
 * @Xml
 * @MusicXML
 * @ParentEelement(name="note")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/notehead/
 * @Data
 */
class Notehead extends MusicXMLWriter
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
	 * Filled
	 * -
	 * Changes the appearance of enclosed shapes from the default of hollow for half notes and longer, and filled otherwise.
	 *
	 * @Attribute(name="filled")
	 * @Value(type="yes-no" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $filled;

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
	 * Parentheses
	 * -
	 * If yes, the notehead is parenthesized. It is no if not specified.
	 *
	 * @Attribute(name="parentheses")
	 * @Value(type="yes-no" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $parentheses;

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
	 * @TextContent
	 * @var string
	 */
	public $textContent;

}