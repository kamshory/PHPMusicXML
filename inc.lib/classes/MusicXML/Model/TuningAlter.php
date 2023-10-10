<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * TuningAlter
 * @Xml
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/tuning-alter/
 * @Data
 */
class TuningAlter extends MusicXMLWriter
{

    /**
	 * Text content
	 *
	 * @TextContent
	 * @var string
	 */
	public $textContent;
}