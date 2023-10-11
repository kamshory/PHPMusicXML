<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Sync
 * @Xml
 * @MusicXML
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/sync/
 * @Data
 */
class Sync extends MusicXMLWriter
{
	/**
	 * Type
	 *
	 * @Attribute(name="type")
	 * @var string
	 */
	public $type;

	/**
	 * Latency
	 *
	 * @Attribute(name="latency")
	 * @var string
	 */
	public $latency;

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