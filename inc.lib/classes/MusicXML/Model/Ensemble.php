<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Ensemble
 * @Xml
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/ensemble/
 * @Data
 */
class Ensemble extends MusicXMLWriter
{
    /**
	 * Text content
	 *
	 * @TextContent
	 * @var integer
	 */
	public $textContent;
}