<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Second
 * @Xml
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/second/
 * @Data
 */
class Second extends MusicXMLWriter
{
    /**
	 * Text content
	 *
	 * @TextContent
	 * @var integer
	 */
	public $textContent;
}