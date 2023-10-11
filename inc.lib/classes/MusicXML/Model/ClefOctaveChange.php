<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * ClefOctaveChange
 * @Xml
 * @MusicXML
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/clef-octave-change/
 * @Data
 */
class ClefOctaveChange extends MusicXMLWriter
{
    /**
	 * Text content
	 *
	 * @TextContent
	 * @var integer
	 */
	public $textContent;
}