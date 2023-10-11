<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * MultipleRest
 * @Xml
 * @MusicXML
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/multiple-rest/
 * @Data
 */
class MultipleRest extends MusicXMLWriter
{
	/**
	 * Use symbols
	 *
	 * @Attribute(name="use-symbols")
	 * @var string
	 */
	public $useSymbols;
    
	/**
	 * Text content
	 *
	 * @TextContent
	 * @var integer
	 */
	public $textContent;
}