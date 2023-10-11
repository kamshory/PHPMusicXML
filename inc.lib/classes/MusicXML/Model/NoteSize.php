<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * NoteSize
 * @Xml
 * @MusicXML
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/note-size/
 * @Data
 */
class NoteSize extends MusicXMLWriter
{
	/**
	 * Type
	 *
	 * @Attribute(name="type")
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