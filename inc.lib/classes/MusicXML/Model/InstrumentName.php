<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * InstrumentName
 * @Xml
 * @MusicXML
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/instrument-name/
 * @Data
 */
class InstrumentName extends MusicXMLWriter
{
    /**
	 * Text content
	 *
	 * @TextContent
	 * @var string
	 */
	public $textContent;
}