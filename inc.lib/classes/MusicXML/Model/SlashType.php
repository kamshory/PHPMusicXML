<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * SlashType
 * @Xml
 * @MusicXML
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/slash-type/
 * @Data
 */
class SlashType extends MusicXMLWriter
{
    /**
	 * Text content
	 *
	 * @TextContent
	 * @var string
	 */
	public $textContent;
}