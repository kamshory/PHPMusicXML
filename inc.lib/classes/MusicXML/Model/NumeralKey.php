<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * NumeralKey
 * -
 * NumeralKey is class of element &lt;numeral-key&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;numeral&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="numeral-key")
 * @ParentElement(name="numeral")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/numeral-key/
 * @Data
 */
class NumeralKey extends MusicXMLWriter
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
     * Numeral fifths
     *
     * @Element(name="numeral-fifths")
     * @var NumeralFifths
     */
    public $numeralFifths;

    /**
     * Numeral mode
     *
     * @Element(name="numeral-mode")
     * @var NumeralMode
     */
    public $numeralMode;

}