<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * CircularArrow
 * -
 * CircularArrow is class of element &lt;circular-arrow&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;arrow&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="circular-arrow")
 * @ParentElement(name="arrow")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/circular-arrow/
 * @Data
 */
class CircularArrow extends MusicXMLWriter
{

    /**
	 * Text content
	 *
	 * @TextContent
	 * @var string
	 */
	public $textContent;
}