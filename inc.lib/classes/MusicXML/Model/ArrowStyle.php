<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * ArrowStyle
 * -
 * ArrowStyle is class of element &lt;arrow-style&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;arrow&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="arrow-style")
 * @ParentElement(name="arrow")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/arrow-style/
 * @Data
 */
class ArrowStyle extends MusicXMLWriter
{

    /**
	 * Text content
	 *
	 * @TextContent
	 * @var string
	 */
	public $textContent;
}