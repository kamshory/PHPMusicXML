<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * First
 * -
 * First is class of element &lt;first&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;swing&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="first")
 * @ParentElement(name="swing")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/first/
 * @Data
 */
class First extends MusicXMLWriter
{

    /**
	 * Text content
	 *
	 * @TextContent
	 * @var integer
	 */
	public $textContent;
}