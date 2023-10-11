<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * DisplayStep
 * @Xml
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/display-step/
 * @Data
 */
class DisplayStep extends MusicXMLWriter
{
    /**
	 * Text content
	 *
	 * @TextContent
	 * @var string
	 */
	public $textContent;
}