<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * MidiName
 * @Xml
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/midi-name/
 * @Data
 */
class MidiName extends MusicXMLWriter
{
    /**
	 * Text content
	 *
	 * @TextContent
	 * @var string
	 */
	public $textContent;
}