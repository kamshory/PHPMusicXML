<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * HarmonClosed
 * @Xml
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/harmon-closed/
 * @Data
 */
class HarmonClosed extends MusicXMLWriter
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