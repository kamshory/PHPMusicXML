<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Chromatic
 * @Xml
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/chromatic/
 * @Data
 */
class Chromatic extends MusicXMLWriter
{
    /**
	 * Text content
	 *
	 * @TextContent
	 * @var float
	 */
	public $textContent;
}