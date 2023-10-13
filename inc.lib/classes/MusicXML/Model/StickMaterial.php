<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * StickMaterial
 * -
 * StickMaterial is class of element &lt;stick-material&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;stick&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="stick-material")
 * @ParentElement(name="stick")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/stick-material/
 * @Data
 */
class StickMaterial extends MusicXMLWriter
{

    /**
	 * Text content
	 *
	 * @TextContent
	 * @var string
	 */
	public $textContent;
}