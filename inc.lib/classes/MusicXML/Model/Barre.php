<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Barre
 * @Xml
 * @MusicXML
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/barre/
 * @Data
 */
class Barre extends MusicXMLWriter
{
	/**
	 * Type
	 *
	 * @Attribute(name="type")
	 * @var string
	 */
	public $type;

	/**
	 * Color
	 *
	 * @Attribute(name="color")
	 * @var string
	 */
	public $color;
    
}