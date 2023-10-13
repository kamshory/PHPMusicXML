<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * BottomMargin
 * -
 * BottomMargin is class of element &lt;bottom-margin&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;page-margins&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="bottom-margin")
 * @ParentElement(name="page-margins")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/bottom-margin/
 * @Data
 */
class BottomMargin extends MusicXMLWriter
{

    /**
	 * Text content
	 *
	 * @TextContent
	 * @var float
	 */
	public $textContent;
}