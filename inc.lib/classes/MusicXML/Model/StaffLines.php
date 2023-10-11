<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * StaffLines
 * @Xml
 * @MusicXML
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