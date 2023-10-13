<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Effect
 * -
 * Effect is class of element &lt;effect&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;percussion&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="effect")
 * @ParentElement(name="percussion")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/effect/
 * @Data
 */
class Effect extends MusicXMLWriter
{
	/**
	 * Smufl
	 * -
	 * Distinguishes different SMuFL stylistic alternates.
	 *
	 * @Attribute(name="smufl")
	 * @Value(type="smufl-pictogram-glyph-name" required="false", allowed="ANY_VALUE")
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