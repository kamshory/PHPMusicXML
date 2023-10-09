<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Technical
 * @Xml
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/technical/
 * @Data
 */
class Technical extends MusicXMLWriter
{
	/**
	 * Id
	 *
	 * @Attribute(name="id")
	 * @var string
	 */
	public $id;

	/**
	 * Up bow
	 *
	 * @Element(name="up-bow")
	 * @var UpBow[]
	 */
	public $upBow;

	/**
	 * Down bow
	 *
	 * @Element(name="down-bow")
	 * @var DownBow[]
	 */
	public $downBow;

	/**
	 * Harmonic
	 *
	 * @Element(name="harmonic")
	 * @var Harmonic[]
	 */
	public $harmonic;
    
}