<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * StickLocation
 * @Xml
 * @MusicXML
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/stick-location/
 * @Data
 */
class StickLocation extends MusicXMLWriter
{
    /**
	 * Text content
	 *
	 * @TextContent
	 * @var string
	 */
	public $textContent;
}