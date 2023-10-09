<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * OtherListen
 * @Xml
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/other-listen/
 * @Data
 */
class OtherListen extends MusicXMLWriter
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
    
}