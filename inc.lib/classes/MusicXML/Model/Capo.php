<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Capo
 * @Xml
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/capo/
 * @Data
 */
class Capo extends MusicXMLWriter
{
    /**
	 * Text content
	 *
	 * @TextContent
	 * @var integer
	 */
	public $textContent;
}