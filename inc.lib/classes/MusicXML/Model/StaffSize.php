<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * StaffSize
 * @Xml
 * @MusicXML
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/staff-size/
 * @Data
 */
class StaffSize extends MusicXMLWriter
{
	/**
	 * Scaling
	 *
	 * @Attribute(name="scaling")
	 * @var string
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