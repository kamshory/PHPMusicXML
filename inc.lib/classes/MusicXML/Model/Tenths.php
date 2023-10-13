<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Tenths
 * -
 * Tenths is class of element &lt;tenths&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;scaling&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="tenths")
 * @ParentElement(name="scaling")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/tenths/
 * @Data
 */
class Tenths extends MusicXMLWriter
{

    /**
	 * Text content
	 *
	 * @TextContent
	 * @var float
	 */
	public $textContent;
}