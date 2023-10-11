<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Elevation
 * @Xml
 * @MusicXML
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/elevation/
 * @Data
 */
class Elevation extends MusicXMLWriter
{
    /**
	 * Text content
	 *
	 * @TextContent
	 * @var float
	 */
	public $textContent;
}