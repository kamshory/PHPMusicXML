<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * PlayerName
 * @Xml
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/player-name/
 * @Data
 */
class PlayerName extends MusicXMLWriter
{
    /**
	 * Text content
	 *
	 * @TextContent
	 * @var string
	 */
	public $textContent;
}