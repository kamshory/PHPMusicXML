<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Line
 * @Xml
 * @MusicXML
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/line/
 * @Data
 */
class Line extends MusicXMLWriter
{
    /**
	 * Text content
	 *
	 * @TextContent
	 * @var integer
	 */
	public $textContent;
}