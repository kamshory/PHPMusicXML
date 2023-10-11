<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * ActualNotes
 * @Xml
 * @MusicXML
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/actual-notes/
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