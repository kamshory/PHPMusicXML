<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * MovementNumber
 * @Xml
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/movement-number/
 * @Data
 */
class MovementNumber extends MusicXMLWriter
{
    /**
	 * Text content
	 *
	 * @TextContent
	 * @var string
	 */
	public $textContent;
}