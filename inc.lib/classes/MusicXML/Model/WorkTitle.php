<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * WorkTitle
 * @Xml
 * @MusicXML
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/work-title/
 * @Data
 */
class WorkTitle extends MusicXMLWriter
{
    /**
	 * Text content
	 *
	 * @TextContent
	 * @var string
	 */
	public $textContent;
}