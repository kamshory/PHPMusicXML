<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * StaffDistance
 * @Xml
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