<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Alter
 * -
 * Alter is class of element &lt;alter&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;pitch&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="alter")
 * @ParentElement(name="pitch")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/alter/
 * @Update(date-time="2023-10-26 11:21:09")
 * @Data
 */
class Alter extends MusicXMLWriter
{

    /**
	 * Text content
	 *
	 * @TextContent
	 * @var float
	 */
	public $textContent;
}