<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * KeyStep
 * @Xml
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/key-step/
 * @Data
 */
class KeyStep extends MusicXMLWriter
{
    /**
	 * Text content
	 *
	 * @TextContent
	 * @var string
	 */
	public $textContent;
}