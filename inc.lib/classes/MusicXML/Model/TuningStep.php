<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * TuningStep
 * @Xml
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/tuning-step/
 * @Data
 */
class TuningStep extends MusicXMLWriter
{
    /**
	 * Text content
	 *
	 * @TextContent
	 * @var string
	 */
	public $textContent;
}