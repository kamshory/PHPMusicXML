<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Group
 * -
 * Group is class of element &lt;group&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;score-part&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="group")
 * @ParentElement(name="score-part")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/group/
 * @Data
 */
class Group extends MusicXMLWriter
{

    /**
	 * Text content
	 *
	 * @TextContent
	 * @var string
	 */
	public $textContent;
}