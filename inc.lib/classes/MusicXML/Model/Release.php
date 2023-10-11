<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Release
 * @Xml
 * @MusicXML
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/release/
 * @Data
 */
class Release extends MusicXMLWriter
{
	/**
	 * Offset
	 *
	 * @Attribute(name="offset")
	 * @var string
	 */
	public $offset;
    
}