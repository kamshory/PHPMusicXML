<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Tenths
 * @Xml
 * @MusicXML
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/tenths/
 * @Data
 */
class Tenths extends MusicXMLWriter
{
    /**
	 * Text content
	 *
	 * @TextContent
	 * @var float
	 */
	public $textContent;
}