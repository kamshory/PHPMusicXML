<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * PageHeight
 * @Xml
 * @MusicXML
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/page-height/
 * @Data
 */
class PageHeight extends MusicXMLWriter
{
    /**
	 * Text content
	 *
	 * @TextContent
	 * @var float
	 */
	public $textContent;
}