<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Volume
 * @Xml
 * @MusicXML
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/volume/
 * @Data
 */
class Volume extends MusicXMLWriter
{
    /**
	 * Text content
	 *
	 * @TextContent
	 * @var float
	 */
	public $textContent;
}