<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Millimeters
 * @Xml
 * @MusicXML
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/millimeters/
 * @Data
 */
class Millimeters extends MusicXMLWriter
{
    /**
	 * Text content
	 *
	 * @TextContent
	 * @var float
	 */
	public $textContent;
}