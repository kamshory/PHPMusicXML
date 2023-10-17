<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * StaffDistance
 * -
 * StaffDistance is class of element &lt;staff-distance&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;staff-layout&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="staff-distance")
 * @ParentElement(name="staff-layout")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/staff-distance/
 * @Data
 */
class StaffDistance extends MusicXMLWriter
{

    /**
	 * Text content
	 *
	 * @TextContent
	 * @var float
	 */
	public $textContent;
}