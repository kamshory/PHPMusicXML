<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * SwingStyle
 * @Xml
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/swing-style/
 * @Data
 */
class SwingStyle extends MusicXMLWriter
{
    /**
	 * Text content
	 *
	 * @TextContent
	 * @var string
	 */
	public $textContent;
}