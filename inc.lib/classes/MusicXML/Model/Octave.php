<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Octave
 * @Xml
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/octave/
 * @Data
 */
class Octave extends MusicXMLWriter
{
    /**
	 * Text content
	 *
	 * @TextContent
	 * @var integer
	 */
	public $textContent;
}