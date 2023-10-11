<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * PartAbbreviationDisplay
 * @Xml
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/part-abbreviation-display/
 * @Data
 */
class PartAbbreviationDisplay extends MusicXMLWriter
{
	/**
	 * Print object
	 *
	 * @Attribute(name="print-object")
	 * @var string
	 */
	public $printObject;
    
}