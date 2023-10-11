<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * LeftMargin
 * @Xml
 * @MusicXML
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/left-margin/
 * @Data
 */
class LeftMargin extends MusicXMLWriter
{
    /**
	 * Text content
	 *
	 * @TextContent
	 * @var float
	 */
	public $textContent;
}