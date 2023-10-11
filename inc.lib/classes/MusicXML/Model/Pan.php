<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Pan
 * @Xml
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/pan/
 * @Data
 */
class Pan extends MusicXMLWriter
{
    /**
	 * Text content
	 *
	 * @TextContent
	 * @var float
	 */
	public $textContent;
}