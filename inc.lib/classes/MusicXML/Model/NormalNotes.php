<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * NormalNotes
 * -
 * NormalNotes is class of element &lt;normal-notes&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;time-modification&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="normal-notes")
 * @ParentElement(name="time-modification")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/normal-notes/
 * @Data
 */
class NormalNotes extends MusicXMLWriter
{

    /**
	 * Text content
	 *
	 * @TextContent
	 * @var integer
	 */
	public $textContent;
}