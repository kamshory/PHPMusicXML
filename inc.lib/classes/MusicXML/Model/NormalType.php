<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * NormalType
 * -
 * NormalType is class of element &lt;normal-type&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;time-modification&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="normal-type")
 * @ParentElement(name="time-modification")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/normal-type/
 * @Update(date-time="2023-10-26 11:24:38")
 * @Data
 */
class NormalType extends MusicXMLWriter
{

    /**
	 * Text content
	 *
	 * @TextContent
	 * @var string
	 */
	public $textContent;
}