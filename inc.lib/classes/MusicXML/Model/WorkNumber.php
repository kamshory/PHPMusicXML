<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * WorkNumber
 * @Xml
 * @MusicXML
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/work-number/
 * @Data
 */
class WorkNumber extends MusicXMLWriter
{
    /**
	 * Text content
	 *
	 * @TextContent
	 * @var string
	 */
	public $textContent;
}