<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Mode
 * -
 * Mode is class of element &lt;mode&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;key&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="mode")
 * @ParentElement(name="key")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/mode/
 * @Update(date-time="2023-10-26 11:24:24")
 * @Data
 */
class Mode extends MusicXMLWriter
{

    /**
	 * Text content
	 *
	 * @TextContent
	 * @var string
	 */
	public $textContent;
}