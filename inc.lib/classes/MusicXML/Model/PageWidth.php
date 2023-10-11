<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * PageWidth
 * @Xml
 * @MusicXML
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/page-width/
 * @Data
 */
class PageWidth extends MusicXMLWriter
{
    /**
	 * Text content
	 *
	 * @TextContent
	 * @var float
	 */
	public $textContent;
}