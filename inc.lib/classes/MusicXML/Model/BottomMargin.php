<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * BottomMargin
 * @Xml
 * @MusicXML
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/bottom-margin/
 * @Data
 */
class BottomMargin extends MusicXMLWriter
{
    /**
	 * Text content
	 *
	 * @TextContent
	 * @var float
	 */
	public $textContent;
}