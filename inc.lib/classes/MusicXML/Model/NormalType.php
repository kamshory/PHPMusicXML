<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * NormalType
 * @Xml
 * @MusicXML
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/normal-type/
 * @Data
 */
class NormalType extends MusicXMLWriter
{
    /**
	 * Text content
	 *
	 * @TextContent
	 * @var string
	 */
	public $textContent;
}