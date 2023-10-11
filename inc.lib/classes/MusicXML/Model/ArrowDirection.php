<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * ArrowDirection
 * @Xml
 * @MusicXML
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/arrow-direction/
 * @Data
 */
class ArrowDirection extends MusicXMLWriter
{
    /**
	 * Text content
	 *
	 * @TextContent
	 * @var string
	 */
	public $textContent;
}