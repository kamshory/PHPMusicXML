<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Elision
 * -
 * Elision is class of element &lt;elision&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;lyric&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="elision")
 * @ParentElement(name="lyric")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/elision/
 * @Data
 */
class Elision extends MusicXMLWriter
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
	 * Smufl
	 * -
	 * Used to specify the elision symbol to use if the element text content is empty. It is ignored otherwise.
	 *
	 * @Attribute(name="smufl")
	 * @Value(type="smufl-lyrics-glyph-name" required="false", allowed="ANY_VALUE")
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