<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Type
 * @Xml
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/type/
 * @Data
 */
class Type extends MusicXMLWriter
{
	/**
	 * Size
	 *
	 * @Attribute(name="size")
	 * @var string
	 */
	public $size;
    
	/**
	 * Text content
	 *
	 * @TextContent
	 * @var string
	 */
	public $textContent;
}