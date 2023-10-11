<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * DisplayOctave
 * @Xml
 * @MusicXML
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/display-octave/
 * @Data
 */
class DisplayOctave extends MusicXMLWriter
{
    /**
	 * Text content
	 *
	 * @TextContent
	 * @var integer
	 */
	public $textContent;
}