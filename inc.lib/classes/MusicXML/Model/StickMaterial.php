<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * StickMaterial
 * @Xml
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/stick-material/
 * @Data
 */
class StickMaterial extends MusicXMLWriter
{
    /**
	 * Text content
	 *
	 * @TextContent
	 * @var string
	 */
	public $textContent;
}