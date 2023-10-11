<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * FirstFret
 * @Xml
 * @MusicXML
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/first-fret/
 * @Data
 */
class FirstFret extends MusicXMLWriter
{
	/**
	 * Location
	 *
	 * @Attribute(name="location")
	 * @var string
	 */
	public $location;

	/**
	 * Text
	 *
	 * @Attribute(name="text")
	 * @var string
	 */
	public $text;
    
	/**
	 * Text content
	 *
	 * @TextContent
	 * @var integer
	 */
	public $textContent;
}