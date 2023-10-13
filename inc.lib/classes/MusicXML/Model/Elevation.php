<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Elevation
 * -
 * Elevation is class of element &lt;elevation&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;midi-instrument&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="elevation")
 * @ParentElement(name="midi-instrument")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/elevation/
 * @Data
 */
class Elevation extends MusicXMLWriter
{

    /**
	 * Text content
	 *
	 * @TextContent
	 * @var float
	 */
	public $textContent;
}