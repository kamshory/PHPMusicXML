<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * InstrumentSound
 * @Xml
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/instrument-sound/
 * @Data
 */
class InstrumentSound extends MusicXMLWriter
{
    /**
	 * Text content
	 *
	 * @TextContent
	 * @var integer
	 */
	public $textContent;
}