<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * PedalStep
 * @Xml
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/pedal-step/
 * @Data
 */
class PedalStep extends MusicXMLWriter
{
    /**
	 * Text content
	 *
	 * @TextContent
	 * @var string
	 */
	public $textContent;
}