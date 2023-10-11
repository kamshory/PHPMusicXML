<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Syllabic
 * @Xml
 * @MusicXML
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/syllabic/
 * @Data
 */
class Syllabic extends MusicXMLWriter
{
    /**
	 * Text content
	 *
	 * @TextContent
	 * @var string
	 */
	public $textContent;
}