<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * TimeRelation
 * @Xml
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/time-relation/
 * @Data
 */
class TimeRelation extends MusicXMLWriter
{
    /**
	 * Text content
	 *
	 * @TextContent
	 * @var string
	 */
	public $textContent;
}