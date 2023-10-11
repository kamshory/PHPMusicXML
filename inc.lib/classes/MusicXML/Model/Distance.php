<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Distance
 * @Xml
 * @MusicXML
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/distance/
 * @Data
 */
class Distance extends MusicXMLWriter
{
	/**
	 * Type
	 *
	 * @Attribute(name="type")
	 * @var string
	 */
	public $type;
    
	/**
	 * Text content
	 *
	 * @TextContent
	 * @var float
	 */
	public $textContent;
}