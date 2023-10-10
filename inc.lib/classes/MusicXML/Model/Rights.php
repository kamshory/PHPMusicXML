<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Rights
 * @Xml
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/rights/
 * @Data
 */
class Rights extends MusicXMLWriter
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