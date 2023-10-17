<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * MovementTitle
 * -
 * MovementTitle is class of element &lt;movement-title&gt; Open link at &#64;Referece to read full documentation.
 * Parent elements: &lt;score-partwise&gt;, &lt;score-timewise&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="movement-title")
 * @ParentElement(name="score-partwise,score-timewise")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/movement-title/
 * @Data
 */
class MovementTitle extends MusicXMLWriter
{

    /**
	 * Text content
	 *
	 * @TextContent
	 * @var string
	 */
	public $textContent;
}