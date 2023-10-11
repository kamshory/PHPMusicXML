<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Mode
 * @Xml
 * @MusicXML
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/mode/
 * @Data
 */
class Mode extends MusicXMLWriter
{
    /**
	 * Text content
	 *
	 * @TextContent
	 * @var string
	 */
	public $textContent;
}