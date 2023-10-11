<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Assess
 * @Xml
 * @MusicXML
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/assess/
 * @Data
 */
class Assess extends MusicXMLWriter
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