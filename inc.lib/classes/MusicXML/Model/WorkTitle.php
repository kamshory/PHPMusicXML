<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * WorkTitle
 * -
 * WorkTitle is class of element &lt;work-title&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;work&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="work-title")
 * @ParentElement(name="work")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/work-title/
 * @Update(date-time="2023-10-26 11:27:47")
 * @Data
 */
class WorkTitle extends MusicXMLWriter
{

    /**
	 * Text content
	 *
	 * @TextContent
	 * @var string
	 */
	public $textContent;
}