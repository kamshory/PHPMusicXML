<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * StaffType
 * @Xml
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/staff-type/
 * @Data
 */
class StaffType extends MusicXMLWriter
{
    /**
	 * Text content
	 *
	 * @TextContent
	 * @var string
	 */
	public $textContent;
}