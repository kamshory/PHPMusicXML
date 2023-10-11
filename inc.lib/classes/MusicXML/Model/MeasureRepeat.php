<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * MeasureRepeat
 * @Xml
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/measure-repeat/
 * @Data
 */
class MeasureRepeat extends MusicXMLWriter
{
	/**
	 * Type
	 *
	 * @Attribute(name="type")
	 * @var string
	 */
	public $type;

	/**
	 * Slashes
	 *
	 * @Attribute(name="slashes")
	 * @var string
	 */
	public $slashes;
    
	/**
	 * Text content
	 *
	 * @TextContent
	 * @var integer
	 */
	public $textContent;
}