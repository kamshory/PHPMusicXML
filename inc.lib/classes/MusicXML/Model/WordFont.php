<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * WordFont
 * -
 * WordFont is class of element &lt;word-font&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;defaults&gt;
 * 
 * @Xml
 * @MusicXML
 * @ParentEelement="defaults")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/word-font/
 * @Data
 */
class WordFont extends MusicXMLWriter
{
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

}