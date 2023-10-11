<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Instruments
 * @Xml
 * @MusicXML
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/instruments/
 * @Data
 */
class Instruments extends MusicXMLWriter
{
    /**
	 * Text content
	 *
	 * @TextContent
	 * @var integer
	 */
	public $textContent;
}