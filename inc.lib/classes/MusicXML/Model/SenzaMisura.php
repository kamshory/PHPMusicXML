<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * SenzaMisura
 * @Xml
 * @MusicXML
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/senza-misura /
 * @Data
 */
class SenzaMisura extends MusicXMLWriter
{
    /**
	 * Text content
	 *
	 * @TextContent
	 * @var string
	 */
	public $textContent;
}