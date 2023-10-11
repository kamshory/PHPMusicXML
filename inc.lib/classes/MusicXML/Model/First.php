<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * First
 * @Xml
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/first/
 * @Data
 */
class First extends MusicXMLWriter
{
    /**
	 * Text content
	 *
	 * @TextContent
	 * @var integer
	 */
	public $textContent;
}