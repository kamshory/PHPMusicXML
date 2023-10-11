<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * MetronomeRelation
 * @Xml
 * @MusicXML
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/metronome-relation/
 * @Data
 */
class MetronomeRelation extends MusicXMLWriter
{
    /**
	 * Text content
	 *
	 * @TextContent
	 * @var string
	 */
	public $textContent;
}