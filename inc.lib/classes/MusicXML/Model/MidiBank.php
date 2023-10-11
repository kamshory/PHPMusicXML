<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * MidiBank
 * @Xml
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/midi-bank/
 * @Data
 */
class MidiBank extends MusicXMLWriter
{
    /**
	 * Text content
	 *
	 * @TextContent
	 * @var integer
	 */
	public $textContent;
}