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
 * @ParentEelement="midi-instrument")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/midi-unpitched/
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