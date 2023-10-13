<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * NoteSize
 * -
 * NoteSize is class of element &lt;note-size&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;appearance&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="note-size")
 * @ParentElement(name="appearance")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/note-size/
 * @Data
 */
class NoteSize extends MusicXMLWriter
{
	/**
	 * Type
	 * -
	 * The type of note size being defined.
	 *
	 * @Attribute(name="type")
	 * @Value(type="note-size-type" required="true", allowed="cue,grace,grace-cue,large")
	 * @var string
	 */
	public $type;

	/**
	 * Text content
	 *
	 * @TextContent
	 * @var float
	 */
	public $textContent;

}