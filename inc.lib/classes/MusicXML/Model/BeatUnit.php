<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * BeatUnit
 * @Xml
 * @MusicXML
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/beat-unit/
 * @Data
 */
class BeatUnit extends MusicXMLWriter
{
    /**
	 * Text content
	 *
	 * @TextContent
	 * @var string
	 */
	public $textContent;
}