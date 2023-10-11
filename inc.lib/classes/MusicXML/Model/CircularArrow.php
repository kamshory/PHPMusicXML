<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * CircularArrow
 * @Xml
 * @MusicXML
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/circular-arrow/
 * @Data
 */
class CircularArrow extends MusicXMLWriter
{
    /**
	 * Text content
	 *
	 * @TextContent
	 * @var string
	 */
	public $textContent;
}