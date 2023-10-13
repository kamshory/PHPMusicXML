<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Capo
 * -
 * Capo is class of element &lt;capo&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;staff-details&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="capo")
 * @ParentElement(name="staff-details")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/capo/
 * @Data
 */
class Capo extends MusicXMLWriter
{

    /**
	 * Text content
	 *
	 * @TextContent
	 * @var integer
	 */
	public $textContent;
}