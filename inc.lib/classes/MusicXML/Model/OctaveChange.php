<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * OctaveChange
 * @Xml
 * @MusicXML
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/octave-change/
 * @Data
 */
class OctaveChange extends MusicXMLWriter
{
    /**
	 * Text content
	 *
	 * @TextContent
	 * @var integer
	 */
	public $textContent;
}