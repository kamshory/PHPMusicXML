<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * BeatType
 * @Xml
 * @MusicXML
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/beat-type/
 * @Data
 */
class BeatType extends MusicXMLWriter
{
    /**
	 * Text content
	 *
	 * @TextContent
	 * @var string
	 */
	public $textContent;
}