<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * SystemDistance
 * @Xml
 * @MusicXML
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/system-distance/
 * @Data
 */
class SystemDistance extends MusicXMLWriter
{
    /**
	 * Text content
	 *
	 * @TextContent
	 * @var float
	 */
	public $textContent;
}