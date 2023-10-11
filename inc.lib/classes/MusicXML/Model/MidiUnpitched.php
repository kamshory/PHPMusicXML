<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * MidiUnpitched
 * @Xml
 * @MusicXML
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/midi-unpitched/
 * @Data
 */
class MidiUnpitched extends MusicXMLWriter
{
    /**
	 * Text content
	 *
	 * @TextContent
	 * @var integer
	 */
	public $textContent;
}