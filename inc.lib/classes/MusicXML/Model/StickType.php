<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * StickType
 * @Xml
 * @MusicXML
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/stick-type/
 * @Data
 */
class StickType extends MusicXMLWriter
{
    /**
	 * Text content
	 *
	 * @TextContent
	 * @var string
	 */
	public $textContent;
}