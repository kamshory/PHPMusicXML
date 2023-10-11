<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * PedalAlter
 * @Xml
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/pedal-alter/
 * @Data
 */
class PedalAlter extends MusicXMLWriter
{
    /**
	 * Text content
	 *
	 * @TextContent
	 * @var float
	 */
	public $textContent;
}