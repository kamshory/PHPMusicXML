<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * MidiChannel
 * -
 * MidiChannel is class of element &lt;midi-channel&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;midi-instrument&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="midi-channel")
 * @ParentElement(name="midi-instrument")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/midi-channel/
 * @Data
 */
class MidiChannel extends MusicXMLWriter
{

    /**
	 * Text content
	 *
	 * @TextContent
	 * @var integer
	 */
	public $textContent;
}