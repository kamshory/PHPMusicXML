<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * MetronomeTied
 * @Xml
 * @MusicXML
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/metronome-tied/
 * @Data
 */
class MetronomeTied extends MusicXMLWriter
{
	/**
	 * Type
	 *
	 * @Attribute(name="type")
	 * @var string
	 */
	public $type;
    
}