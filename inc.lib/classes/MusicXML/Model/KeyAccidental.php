<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * KeyAccidental
 * -
 * KeyAccidental is class of element &lt;key-accidental&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;key&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="key-accidental")
 * @ParentElement(name="key")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/key-accidental/
 * @Data
 */
class KeyAccidental extends MusicXMLWriter
{
	/**
	 * Smufl
	 * -
	 * Specifies a Standard Music Font Layout (SMuFL) accidental character by its canonical glyph name.
	 *
	 * @Attribute(name="smufl")
	 * @Value(type="smufl-accidental-glyph-name" required="false", allowed="ANY_VALUE")
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