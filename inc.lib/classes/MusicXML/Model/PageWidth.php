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
 * @Update(date-time="2023-10-26 11:25:09")
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