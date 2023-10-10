<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Beater
 * @Xml
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/beater/
 * @Data
 */
class Beater extends MusicXMLWriter
{
	/**
	 * Tip
	 *
	 * @Attribute(name="tip")
	 * @var string
	 */
	public $tip;
    
	/**
	 * Text content
	 *
	 * @TextContent
	 * @var string
	 */
	public $textContent;
}