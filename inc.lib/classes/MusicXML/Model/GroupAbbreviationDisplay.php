<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * GroupAbbreviationDisplay
 * @Xml
 * @MusicXML
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/group-abbreviation-display/
 * @Data
 */
class GroupAbbreviationDisplay extends MusicXMLWriter
{
	/**
	 * Print object
	 *
	 * @Attribute(name="print-object")
	 * @var string
	 */
	public $printObject;
    
	/**
     * Display text
     *
     * @Element(name="display-text")
     * @var DisplayText[]
     */
    public $displayText;

    /**
     * Accidental text
     *
     * @Element(name="accidental-text")
     * @var AccidentalText[]
     */
    public $accidentalText;

}