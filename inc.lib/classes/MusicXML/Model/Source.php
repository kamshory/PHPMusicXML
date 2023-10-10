<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Source
 * @Xml
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/source/
 * @Data
 */
class Source extends MusicXMLWriter
{
    /**
	 * Text content
	 *
	 * @TextContent
	 * @var string
	 */
	public $textContent;
}