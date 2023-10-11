<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * BarStyle
 * @Xml
 * @MusicXML
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/bar-style/
 * @Data
 */
class BarStyle extends MusicXMLWriter
{
	/**
	 * Color
	 *
	 * @Attribute(name="color")
	 * @var string
	 */
	public $color;
    
	/**
	 * Text content
	 *
	 * @TextContent
	 * @var string
	 */
	public $textContent;
}