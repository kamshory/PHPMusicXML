<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * NumeralKey
 * @Xml
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/numeral-key/
 * @Data
 */
class NumeralKey extends MusicXMLWriter
{
	/**
	 * Print object
	 *
	 * @Attribute(name="print-object")
	 * @var string
	 */
	public $printObject;
    
    /*
     * Numeral fifths
     *
     * @Element(name="numeral-fifths")
     * @var NumeralFifths
     */
    public $numeralFifths;

    /*
     * Numeral mode
     *
     * @Element(name="numeral-mode")
     * @var NumeralMode
     */
    public $numeralMode;

}