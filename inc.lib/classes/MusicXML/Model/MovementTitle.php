<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * MovementTitle
 * @Xml
 * @MusicXML
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/movement-title/
 * @Data
 */
class MovementTitle extends MusicXMLWriter
{
    /**
	 * Text content
	 *
	 * @TextContent
	 * @var string
	 */
	public $textContent;
}