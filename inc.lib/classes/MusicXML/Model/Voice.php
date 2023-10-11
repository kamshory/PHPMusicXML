<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Voice
 * @Xml
 * @MusicXML
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/voice/
 * @Data
 */
class Voice extends MusicXMLWriter
{
    /**
	 * Text content
	 *
	 * @TextContent
	 * @var string
	 */
	public $textContent;
}