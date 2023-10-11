<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * TopMargin
 * @Xml
 * @MusicXML
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/top-margin/
 * @Data
 */
class TopMargin extends MusicXMLWriter
{
    /**
	 * Text content
	 *
	 * @TextContent
	 * @var float
	 */
	public $textContent;
}