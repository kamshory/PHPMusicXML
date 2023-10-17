<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * StaffSize
 * -
 * StaffSize is class of element &lt;staff-size&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;staff-details&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="staff-size")
 * @ParentElement(name="staff-details")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/staff-size/
 * @Data
 */
class StaffSize extends MusicXMLWriter
{
	/**
	 * Scaling
	 * -
	 * Specifies the percentage scaling that applies to the notation. Values less that 100 make the notation smaller while values over 100 make the notation larger.
	 *
	 * @Attribute(name="scaling")
	 * @Value(type="non-negative-decimal" required="false", min="-infinite", max="infinite")
	 * @var float
	 */
	public $scaling;

	/**
	 * Text content
	 *
	 * @TextContent
	 * @var float
	 */
	public $textContent;
}