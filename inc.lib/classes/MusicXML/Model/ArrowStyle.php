<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * ArrowStyle
 * @Xml
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/arrow-style/
 * @Data
 */
class ArrowStyle extends MusicXMLWriter
{
    /**
	 * Text content
	 *
	 * @TextContent
	 * @var string
	 */
	public $textContent;
}