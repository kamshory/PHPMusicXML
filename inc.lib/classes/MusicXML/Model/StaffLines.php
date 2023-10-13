<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * StaffLines
 * -
 * StaffLines is class of element &lt;staff-lines&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;staff-details&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="staff-lines")
 * @ParentElement(name="staff-details")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/staff-lines/
 * @Data
 */
class StaffLines extends MusicXMLWriter
{

    /**
	 * Text content
	 *
	 * @TextContent
	 * @var string
	 */
	public $textContent;
}