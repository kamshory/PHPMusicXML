<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Cancel
 * @Xml
 * @MusicXML
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/cancel/
 * @Data
 */
class Cancel extends MusicXMLWriter
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
	 * @var integer
	 */
	public $textContent;
}