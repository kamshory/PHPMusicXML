<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * TopSystemDistance
 * -
 * TopSystemDistance is class of element &lt;top-system-distance&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;system-layout&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="top-system-distance")
 * @ParentElement(name="system-layout")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/top-system-distance/
 * @Update(date-time="2023-10-26 11:27:15")
 * @Data
 */
class TopSystemDistance extends MusicXMLWriter
{

    /**
	 * Text content
	 *
	 * @TextContent
	 * @var float
	 */
	public $textContent;
}