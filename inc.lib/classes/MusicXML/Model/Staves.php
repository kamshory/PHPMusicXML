<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Staves
 * @Xml
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/staves/
 * @Data
 */
class Staves extends MusicXMLWriter
{
    /**
	 * Text content
	 *
	 * @TextContent
	 * @var integer
	 */
	public $textContent;
}