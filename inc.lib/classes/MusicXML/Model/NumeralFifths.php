<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * NumeralFifths
 * @Xml
 * @MusicXML
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/numeral-fifths/
 * @Data
 */
class NumeralFifths extends MusicXMLWriter
{
    /**
	 * Text content
	 *
	 * @TextContent
	 * @var string
	 */
	public $textContent;
}