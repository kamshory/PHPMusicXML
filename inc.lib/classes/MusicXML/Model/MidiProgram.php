<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * MidiProgram
 * -
 * MidiProgram is class of element &lt;midi-program&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;midi-instrument&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="midi-program")
 * @ParentElement(name="midi-instrument")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/midi-program/
 * @Update(date-time="2023-10-26 11:24:19")
 * @Data
 */
class MidiProgram extends MusicXMLWriter
{

    /**
	 * Text content
	 *
	 * @TextContent
	 * @var integer
	 */
	public $textContent;
}