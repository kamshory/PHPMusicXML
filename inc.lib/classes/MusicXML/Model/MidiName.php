<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * MidiName
 * -
 * MidiName is class of element &lt;midi-name&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;midi-instrument&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="midi-name")
 * @ParentElement(name="midi-instrument")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/midi-name/
 * @Data
 */
class MidiName extends MusicXMLWriter
{

    /**
	 * Text content
	 *
	 * @TextContent
	 * @var string
	 */
	public $textContent;
}