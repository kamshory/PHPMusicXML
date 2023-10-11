<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * NumeralMode
 * @Xml
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/numeral-mode/
 * @Data
 */
class NumeralMode extends MusicXMLWriter
{
    /**
	 * Text content
	 *
	 * @TextContent
	 * @var string
	 */
	public $textContent;
}