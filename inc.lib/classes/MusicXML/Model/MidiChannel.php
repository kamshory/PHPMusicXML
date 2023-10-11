<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * MidiChannel
 * @Xml
 * @MusicXML
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/midi-channel/
 * @Data
 */
class MidiChannel extends MusicXMLWriter
{
    /**
	 * Text content
	 *
	 * @TextContent
	 * @var integer
	 */
	public $textContent;
}