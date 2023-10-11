<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * KeyAlter
 * @Xml
 * @MusicXML
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/key-alter/
 * @Data
 */
class KeyAlter extends MusicXMLWriter
{
    /**
	 * Text content
	 *
	 * @TextContent
	 * @var float
	 */
	public $textContent;
}