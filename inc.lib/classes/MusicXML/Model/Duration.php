<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Duration
 * @Xml
 * @MusicXML
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/duration/
 * @Data
 */
class Duration extends MusicXMLWriter
{
    /**
	 * Text content
	 *
	 * @TextContent
	 * @var integer
	 */
	public $textContent;
}