<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * StickLocation
 * -
 * StickLocation is class of element &lt;stick-location&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;percussion&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="stick-location")
 * @ParentElement(name="percussion")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/stick-location/
 * @Data
 */
class StickLocation extends MusicXMLWriter
{

    /**
	 * Text content
	 *
	 * @TextContent
	 * @var string
	 */
	public $textContent;
}