<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * FrameStrings
 * @Xml
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/frame-strings/
 * @Data
 */
class FrameStrings extends MusicXMLWriter
{
    /**
	 * Text content
	 *
	 * @TextContent
	 * @var integer
	 */
	public $textContent;
}