<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * SwingType
 * @Xml
 * @MusicXML
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/swing-type/
 * @Data
 */
class SwingType extends MusicXMLWriter
{
    /**
	 * Text content
	 *
	 * @TextContent
	 * @var string
	 */
	public $textContent;
}