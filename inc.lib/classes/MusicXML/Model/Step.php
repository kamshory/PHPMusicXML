<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Step
 * @Xml
 * @MusicXML
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/step/
 * @Data
 */
class Step extends MusicXMLWriter
{
    /**
	 * Text content
	 *
	 * @TextContent
	 * @var string
	 */
	public $textContent;
}