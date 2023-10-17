<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Glyph
 * -
 * Glyph is class of element &lt;glyph&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;appearance&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="glyph")
 * @ParentElement(name="appearance")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/glyph/
 * @Data
 */
class Glyph extends MusicXMLWriter
{
	/**
	 * Type
	 * -
	 * The type of glyph that is being defined.
	 *
	 * @Attribute(name="type")
	 * @Value(type="glyph-type" required="true", allowed="ANY_VALUE")
	 * @var string
	 */
	public $type;

	/**
	 * Text content
	 *
	 * @TextContent
	 * @var string
	 */
	public $textContent;
}