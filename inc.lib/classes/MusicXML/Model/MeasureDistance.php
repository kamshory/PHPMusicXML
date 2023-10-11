<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * MeasureDistance
 * @Xml
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/measure-distance/
 * @Data
 */
class MeasureDistance extends MusicXMLWriter
{
    /**
	 * Text content
	 *
	 * @TextContent
	 * @var float
	 */
	public $textContent;
}