<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Millimeters
 * -
 * Millimeters is class of element &lt;millimeters&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;scaling&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="millimeters")
 * @ParentElement(name="scaling")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/millimeters/
 * @Data
 */
class Millimeters extends MusicXMLWriter
{

    /**
	 * Text content
	 *
	 * @TextContent
	 * @var float
	 */
	public $textContent;
}