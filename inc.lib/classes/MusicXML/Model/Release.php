<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Release
 * -
 * Release is class of element &lt;release&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;bend&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="release")
 * @ParentElement(name="bend")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/release/
 * @Data
 */
class Release extends MusicXMLWriter
{
	/**
	 * Offset
	 * -
	 * Specifies where the release starts in terms of divisions relative to the current note.
	 *
	 * @Attribute(name="offset")
	 * @Value(type="divisions" required="false", min="-infinite", max="infinite")
	 * @var float
	 */
	public $offset;

}