<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Divisions
 * @Xml
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/divisions/
 * @Data
 */
class Divisions extends MusicXMLWriter
{
    /**
	 * Text content
	 *
	 * @TextContent
	 * @var integer
	 */
	public $textContent;
}