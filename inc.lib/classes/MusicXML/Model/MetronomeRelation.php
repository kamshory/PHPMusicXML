<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * MetronomeRelation
 * -
 * MetronomeRelation is class of element &lt;metronome-relation&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;metronome&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="metronome-relation")
 * @ParentElement(name="metronome")
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