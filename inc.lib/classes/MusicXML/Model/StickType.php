<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * StickType
 * -
 * StickType is class of element &lt;stick-type&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;stick&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="stick-type")
 * @ParentElement(name="stick")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/stick-type/
 * @Data
 */
class StickType extends MusicXMLWriter
{

    /**
	 * Text content
	 *
	 * @TextContent
	 * @var string
	 */
	public $textContent;
}