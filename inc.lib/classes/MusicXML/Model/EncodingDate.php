<?php

namespace MusicXML\Model;

use DateTime;
use MusicXML\MusicXMLWriter;

/**
 * EncodingDate
 * @Xml
 * @MusicXML
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/encoding-date/
 * @Data
 */
class EncodingDate extends MusicXMLWriter
{
    /**
	 * Text content
	 *
	 * @TextContent
	 * @var DateTime
	 */
	public $textContent;
}