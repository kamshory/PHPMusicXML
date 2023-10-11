<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Double
 * @Xml
 * @MusicXML
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/double/
 * @Data
 */
class Double extends MusicXMLWriter
{
	/**
	 * Above
	 *
	 * @Attribute(name="above")
	 * @var string
	 */
	public $above;
    
}