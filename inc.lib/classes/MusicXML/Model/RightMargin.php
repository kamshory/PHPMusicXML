<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * RightMargin
 * @Xml
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/right-margin/
 * @Data
 */
class RightMargin extends MusicXMLWriter
{
    /**
	 * Text content
	 *
	 * @TextContent
	 * @var float
	 */
	public $textContent;
}