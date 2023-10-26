<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Step
 * -
 * Step is class of element &lt;step&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;pitch&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="step")
 * @ParentElement(name="pitch")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/step/
 * @Update(date-time="2023-10-26 11:26:39")
 * @Data
 */
class Step extends MusicXMLWriter
{

    /**
	 * Text content
	 *
	 * @TextContent
	 * @var string
	 */
	public $textContent;
}