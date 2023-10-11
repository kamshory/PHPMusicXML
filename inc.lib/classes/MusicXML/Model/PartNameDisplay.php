<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * PartNameDisplay
 * @Xml
 * @MusicXML
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/part-name-display/
 * @Data
 */
class PartNameDisplay extends MusicXMLWriter
{
	/**
	 * Print object
	 *
	 * @Attribute(name="print-object")
	 * @var string
	 */
	public $printObject;
    
	/*
     * Display text
     *
     * @Element(name="display-text")
     * @var DisplayText
     */
    public $displayText;

    /**
     * Accidental text
     *
     * @Element(name="accidental-text")
     * @var AccidentalText
     */
    public $accidentalText;

}