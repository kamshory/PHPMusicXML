<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * HoleClosed
 * @Xml
 * @MusicXML
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/hole-closed/
 * @Data
 */
class HoleClosed extends MusicXMLWriter
{
	/**
	 * Location
	 *
	 * @Attribute(name="location")
	 * @var string
	 */
	public $location;
    
	/**
	 * Text content
	 *
	 * @TextContent
	 * @var string
	 */
	public $textContent;
}