<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * HoleShape
 * @Xml
 * @MusicXML
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/hole-shape/
 * @Data
 */
class HoleShape extends MusicXMLWriter
{
    /**
	 * Text content
	 *
	 * @TextContent
	 * @var string
	 */
	public $textContent;
}