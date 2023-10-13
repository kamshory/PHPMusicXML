<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * SystemDistance
 * -
 * SystemDistance is class of element &lt;system-distance&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;system-layout&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="system-distance")
 * @ParentElement(name="system-layout")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/system-distance/
 * @Data
 */
class SystemDistance extends MusicXMLWriter
{

    /**
	 * Text content
	 *
	 * @TextContent
	 * @var float
	 */
	public $textContent;
}