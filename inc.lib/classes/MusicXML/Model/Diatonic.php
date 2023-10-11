<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Diatonic
 * @Xml
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/diatonic/
 * @Data
 */
class Diatonic extends MusicXMLWriter
{
    /**
	 * Text content
	 *
	 * @TextContent
	 * @var integer
	 */
	public $textContent;
}