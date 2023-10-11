<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * FrameFrets
 * @Xml
 * @MusicXML
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/frame-frets/
 * @Data
 */
class FrameFrets extends MusicXMLWriter
{
    /**
	 * Text content
	 *
	 * @TextContent
	 * @var integer
	 */
	public $textContent;
}