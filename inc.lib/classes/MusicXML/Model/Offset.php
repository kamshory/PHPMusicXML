<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Offset
 * @Xml
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/offset/
 * @Data
 */
class Offset extends MusicXMLWriter
{
	/**
	 * Sound
	 *
	 * @Attribute(name="sound")
	 * @var string
	 */
	public $sound;
    
	/**
	 * Text content
	 *
	 * @TextContent
	 * @var string
	 */
	public $textContent;
}