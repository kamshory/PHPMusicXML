<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Fifths
 * @Xml
 * @MusicXML
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/fifths/
 * @Data
 */
class Fifths extends MusicXMLWriter
{
    /**
	 * Text content
	 *
	 * @TextContent
	 * @var integer
	 */
	public $textContent;
}