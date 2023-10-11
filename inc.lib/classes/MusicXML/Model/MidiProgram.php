<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * MidiProgram
 * @Xml
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/midi-program/
 * @Data
 */
class MidiProgram extends MusicXMLWriter
{
    /**
	 * Text content
	 *
	 * @TextContent
	 * @var integer
	 */
	public $textContent;
}