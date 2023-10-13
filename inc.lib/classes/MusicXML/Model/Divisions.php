<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Divisions
 * -
 * Divisions is class of element &lt;divisions&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;attributes&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="divisions")
 * @ParentElement(name="attributes")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/divisions/
 * @Data
 */
class Divisions extends MusicXMLWriter
{

    /**
	 * Text content
	 *
	 * @TextContent
	 * @var integer
	 */
	public $textContent;
}