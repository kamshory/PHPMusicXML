<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * MidiUnpitched
 * -
 * MidiUnpitched is class of element &lt;midi-unpitched&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;midi-instrument&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="midi-unpitched")
 * @ParentElement(name="midi-instrument")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/midi-unpitched/
 * @Update(date-time="2023-10-26 11:24:20")
 * @Data
 */
class MidiUnpitched extends MusicXMLWriter
{

    /**
	 * Text content
	 *
	 * @TextContent
	 * @var integer
	 */
	public $textContent;
}