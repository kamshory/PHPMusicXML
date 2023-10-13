<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Accord
 * -
 * Accord is class of element &lt;accord&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;scordatura&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="accord")
 * @ParentElement(name="scordatura")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/accord/
 * @Data
 */
class Accord extends MusicXMLWriter
{
	/**
	 * String
	 * -
	 * Strings are numbered from high to low.
	 *
	 * @Attribute(name="string")
	 * @Value(type="string-number" required="false", min="-infinite", max="infinite")
	 * @var integer
	 */
	public $string;

    /**
     * Tuning step
     *
     * @Element(name="tuning-step")
     * @var TuningStep
     */
    public $tuningStep;

    /**
     * Tuning alter
     *
     * @Element(name="tuning-alter")
     * @var TuningAlter
     */
    public $tuningAlter;

    /**
     * Tuning octave
     *
     * @Element(name="tuning-octave")
     * @var TuningOctave
     */
    public $tuningOctave;

}