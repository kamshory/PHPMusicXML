<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * PageWidth
 * -
 * PageWidth is class of element &lt;page-width&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;page-layout&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="page-width")
 * @ParentElement(name="page-layout")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/page-width/
 * @Data
 */
class PageWidth extends MusicXMLWriter
{

    /**
	 * Text content
	 *
	 * @TextContent
	 * @var float
	 */
	public $textContent;
}