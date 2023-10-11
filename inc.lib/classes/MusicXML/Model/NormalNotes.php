<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * NormalNotes
 * @Xml
 * @MusicXML
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