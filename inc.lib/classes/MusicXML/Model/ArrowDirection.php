<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * ArrowDirection
 * -
 * ArrowDirection is class of element &lt;arrow-direction&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;arrow&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="arrow-direction")
 * @ParentElement(name="arrow")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/arrow-direction/
 * @Data
 */
class ArrowDirection extends MusicXMLWriter
{

    /**
	 * Text content
	 *
	 * @TextContent
	 * @var string
	 */
	public $textContent;
}