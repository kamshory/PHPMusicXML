<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * MetronomeBeam
 * -
 * MetronomeBeam is class of element &lt;metronome-beam&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;metronome-note&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="metronome-beam")
 * @ParentElement(name="metronome-note")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/metronome-beam/
 * @Data
 */
class MetronomeBeam extends MusicXMLWriter
{
	/**
	 * Number
	 * -
	 * Indicates eighth note through 1024th note beams using number values 1 thru 8 respectively. The default value is 1.
	 *
	 * @Attribute(name="number")
	 * @Value(type="beam-level" required="false", min="-infinite", max="infinite")
	 * @var integer
	 */
	public $number;

	/**
	 * Text content
	 *
	 * @TextContent
	 * @var string
	 */
	public $textContent;
}