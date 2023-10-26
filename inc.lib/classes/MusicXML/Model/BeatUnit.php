<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * BeatUnit
 * -
 * BeatUnit is class of element &lt;beat-unit&gt; Open link at &#64;Referece to read full documentation.
 * Parent elements: &lt;beat-unit-tied&gt;, &lt;metronome&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="beat-unit")
 * @ParentElement(name="beat-unit-tied,metronome")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/beat-unit/
 * @Update(date-time="2023-10-26 11:21:32")
 * @Data
 */
class BeatUnit extends MusicXMLWriter
{

    /**
	 * Text content
	 *
	 * @TextContent
	 * @var string
	 */
	public $textContent;
}