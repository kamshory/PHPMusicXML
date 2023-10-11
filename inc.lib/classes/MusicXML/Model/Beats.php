<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Beats
 * @Xml
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/beats/
 * @Data
 */
class Beats extends MusicXMLWriter
{
    /**
	 * Text content
	 *
	 * @TextContent
	 * @var string
	 */
	public $textContent;
}