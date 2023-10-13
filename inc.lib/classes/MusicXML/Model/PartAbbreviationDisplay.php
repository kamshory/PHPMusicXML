<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * PartAbbreviationDisplay
 * -
 * PartAbbreviationDisplay is class of element &lt;part-abbreviation-display&gt; Open link at &#64;Referece to read full documentation.
 * Parent elements: &lt;print&gt;, &lt;score-part&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="part-abbreviation-display")
 * @ParentElement(name="print,score-part")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/part-abbreviation-display/
 * @Data
 */
class PartAbbreviationDisplay extends MusicXMLWriter
{
	/**
	 * Print object
	 * -
	 * Specifies whether or not to print an object. It is yes if not specified.
	 *
	 * @Attribute(name="print-object")
	 * @Value(type="yes-no" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $printObject;

	/**
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