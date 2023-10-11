<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * OtherListening
 * @Xml
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/other-listening/
 * @Data
 */
class OtherListening extends MusicXMLWriter
{
	/**
	 * Type
	 *
	 * @Attribute(name="type")
	 * @var string
	 */
	public $type;

	/**
	 * Player
	 *
	 * @Attribute(name="player")
	 * @var string
	 */
	public $player;

	/**
	 * Time only
	 *
	 * @Attribute(name="time-only")
	 * @var string
	 */
	public $timeOnly;
    
	/**
	 * Text content
	 *
	 * @TextContent
	 * @var string
	 */
	public $textContent;
}