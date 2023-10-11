<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * MetronomeType
 * @Xml
 * @MusicXML
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/metronome-type/
 * @Data
 */
class MetronomeType extends MusicXMLWriter
{
    /**
	 * Text content
	 *
	 * @TextContent
	 * @var string
	 */
	public $textContent;
}