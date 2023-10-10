<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * TuningOctave
 * @Xml
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/tuning-octave/
 * @Data
 */
class TuningOctave extends MusicXMLWriter
{
    /**
	 * Text content
	 *
	 * @TextContent
	 * @var string
	 */
	public $textContent;
}