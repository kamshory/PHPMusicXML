<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Fifths
 * -
 * Fifths is class of element &lt;fifths&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;key&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="fifths")
 * @ParentElement(name="key")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/fifths/
 * @Data
 */
class Fifths extends MusicXMLWriter
{

    /**
	 * Text content
	 *
	 * @TextContent
	 * @var integer
	 */
	public $textContent;
}