<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Wait
 * @Xml
 * @MusicXML
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/wait/
 * @Data
 */
class Wait extends MusicXMLWriter
{
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