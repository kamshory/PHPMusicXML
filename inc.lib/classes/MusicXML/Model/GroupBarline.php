<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * GroupBarline
 * @Xml
 * @MusicXML
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/group-barline/
 * @Data
 */
class GroupBarline extends MusicXMLWriter
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