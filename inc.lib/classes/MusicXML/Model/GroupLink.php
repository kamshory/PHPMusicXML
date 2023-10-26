<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * GroupLink
 * -
 * GroupLink is class of element &lt;group-link&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;part-link&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="group-link")
 * @ParentElement(name="part-link")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/group-link/
 * @Update(date-time="2023-10-26 11:23:07")
 * @Data
 */
class GroupLink extends MusicXMLWriter
{

    /**
	 * Text content
	 *
	 * @TextContent
	 * @var string
	 */
	public $textContent;
}