<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * LyricLanguage
 * -
 * LyricLanguage is class of element &lt;lyric-language&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;defaults&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="lyric-language")
 * @ParentElement(name="defaults")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/lyric-language/
 * @Data
 */
class LyricLanguage extends MusicXMLWriter
{
	/**
	 * Xml:lang
	 * -
	 * The default language for the specified lyric name and number.
	 *
	 * @Attribute(name="xml:lang")
	 * @Value(type="xml:lang" required="true", allowed="ANY_VALUE")
	 * @var string
	 */
	public $xmlLang;

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