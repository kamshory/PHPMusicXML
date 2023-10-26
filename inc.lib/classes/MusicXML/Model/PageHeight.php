<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * PageHeight
 * -
 * PageHeight is class of element &lt;page-height&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;page-layout&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="page-height")
 * @ParentElement(name="page-layout")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/page-height/
 * @Update(date-time="2023-10-26 11:25:06")
 * @Data
 */
class PageHeight extends MusicXMLWriter
{

    /**
	 * Text content
	 *
	 * @TextContent
	 * @var float
	 */
	public $textContent;
}