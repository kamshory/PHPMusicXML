<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * SwingStyle
 * -
 * SwingStyle is class of element &lt;swing-style&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;swing&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="swing-style")
 * @ParentElement(name="swing")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/swing-style/
 * @Update(date-time="2023-10-26 11:26:53")
 * @Data
 */
class SwingStyle extends MusicXMLWriter
{

    /**
	 * Text content
	 *
	 * @TextContent
	 * @var string
	 */
	public $textContent;
}