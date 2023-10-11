<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Player
 * @Xml
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/player/
 * @Data
 */
class Player extends MusicXMLWriter
{
	/**
	 * Id
	 *
	 * @Attribute(name="id")
	 * @var string
	 */
	public $id;
    
	/**
	 * Player name
	 *
	 * @Element(name="player-name")
	 * @var PlayerName
	 */
	public $playerName;
}