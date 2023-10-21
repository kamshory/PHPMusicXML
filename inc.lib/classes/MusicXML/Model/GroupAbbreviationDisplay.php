<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * GroupAbbreviationDisplay
 * -
 * GroupAbbreviationDisplay is class of element &lt;group-abbreviation-display&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;part-group&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="group-abbreviation-display")
 * @ParentElement(name="part-group")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/group-abbreviation-display/
 * @Data
 */
class GroupAbbreviationDisplay extends MusicXMLWriter
{
	/**
	 * Print object
	 * -
	 * Specifies whether or not to print an object. It is yes if not specified.
	 *
	 * @Attribute(name="print-object")
	 * @Value(type="yes-no" required="false", allowed="yes,no")
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