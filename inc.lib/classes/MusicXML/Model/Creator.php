<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Creator
 * @Xml
 * @MusicXML
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/creator/
 * @Data
 */
class Creator extends MusicXMLWriter
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
	 * @var string
	 */
	public $textContent;
}