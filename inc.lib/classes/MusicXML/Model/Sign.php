<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Sign
 * @Xml
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/sign/
 * @Data
 */
class Sign extends MusicXMLWriter
{
    /**
	 * Text content
	 *
	 * @TextContent
	 * @var string
	 */
	public $textContent;
}