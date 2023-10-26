<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * ActualNotes
 * -
 * ActualNotes is class of element &lt;actual-notes&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;time-modification&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="actual-notes")
 * @ParentElement(name="time-modification")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/actual-notes/
 * @Update(date-time="2023-10-26 11:21:08")
 * @Data
 */
class ActualNotes extends MusicXMLWriter
{

    /**
	 * Text content
	 *
	 * @TextContent
	 * @var integer
	 */
	public $textContent;
}