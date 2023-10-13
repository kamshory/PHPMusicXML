<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * MetronomeType
 * -
 * MetronomeType is class of element &lt;metronome-type&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;metronome-note&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="metronome-type")
 * @ParentElement(name="metronome-note")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/metronome-type/
 * @Data
 */
class MetronomeType extends MusicXMLWriter
{

    /**
	 * Text content
	 *
	 * @TextContent
	 * @var string
	 */
	public $textContent;
}