<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * TopSystemDistance
 * @Xml
 * @MusicXML
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/top-system-distance/
 * @Data
 */
class TopSystemDistance extends MusicXMLWriter
{
    /**
	 * Text content
	 *
	 * @TextContent
	 * @var float
	 */
	public $textContent;
}