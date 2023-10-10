<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Alter
 * @Xml
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/alter/
 * @Data
 */
class Alter extends MusicXMLWriter
{
    /**
	 * Text content
	 *
	 * @TextContent
	 * @var float
	 */
	public $textContent;
}