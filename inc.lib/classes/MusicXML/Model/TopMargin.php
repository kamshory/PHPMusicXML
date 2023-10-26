<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * TopMargin
 * -
 * TopMargin is class of element &lt;top-margin&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;page-margins&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="top-margin")
 * @ParentElement(name="page-margins")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/top-margin/
 * @Update(date-time="2023-10-26 11:27:14")
 * @Data
 */
class TopMargin extends MusicXMLWriter
{

    /**
	 * Text content
	 *
	 * @TextContent
	 * @var float
	 */
	public $textContent;
}