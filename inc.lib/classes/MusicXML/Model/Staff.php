<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Staff
 * @Xml
 * @MusicXML
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/staff/
 * @Data
 */
class Staff extends MusicXMLWriter
{
    /**
	 * Text content
	 *
	 * @TextContent
	 * @var integer
	 */
	public $textContent;
}