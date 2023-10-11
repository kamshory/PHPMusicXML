<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Repeat
 * @Xml
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/repeat/
 * @Data
 */
class Repeat extends MusicXMLWriter
{
	/**
	 * Direction
	 *
	 * @Attribute(name="direction")
	 * @var string
	 */
	public $direction;

	/**
	 * After jump
	 *
	 * @Attribute(name="after-jump")
	 * @var string
	 */
	public $afterJump;

	/**
	 * Times
	 *
	 * @Attribute(name="times")
	 * @var string
	 */
	public $times;

	/**
	 * Winged
	 *
	 * @Attribute(name="winged")
	 * @var string
	 */
	public $winged;
    
}