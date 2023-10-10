<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Timpani
 * @Xml
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/timpani/
 * @Data
 */
class Timpani extends MusicXMLWriter
{
	/**
	 * Smufl
	 *
	 * @Attribute(name="smufl")
	 * @var string
	 */
	public $smufl;
 
	/**
	 * Text content
	 *
	 * @TextContent
	 * @var string
	 */
	public $textContent;
}