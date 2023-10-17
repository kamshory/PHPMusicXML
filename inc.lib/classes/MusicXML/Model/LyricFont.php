<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * LyricFont
 * -
 * LyricFont is class of element &lt;lyric-font&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;defaults&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="lyric-font")
 * @ParentElement(name="defaults")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/lyric-font/
 * @Data
 */
class LyricFont extends MusicXMLWriter
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

	/**
	 * Name
	 * -
	 * The lyric name for which this is the default, corresponding to the name attribute in the &lt;lyric&gt; element.
	 *
	 * @Attribute(name="name")
	 * @Value(type="token" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $name;

	/**
	 * Number
	 * -
	 * The lyric number for which this is the default, corresponding to the number attribute in the &lt;lyric&gt; element.
	 *
	 * @Attribute(name="number")
	 * @Value(type="NMTOKEN" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $number;

}