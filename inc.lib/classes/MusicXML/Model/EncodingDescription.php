<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * EncodingDescription
 * @Xml
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/encoding-description/
 * @Data
 */
class EncodingDescription extends MusicXMLWriter
{
    /**
	 * Text content
	 *
	 * @TextContent
	 * @var string
	 */
	public $textContent;
}