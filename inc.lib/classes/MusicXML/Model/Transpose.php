<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Transpose
 * -
 * Transpose is class of element &lt;transpose&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;attributes&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="transpose")
 * @ParentElement(name="attributes")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/transpose/
 * @Data
 */
class Transpose extends MusicXMLWriter
{
	/**
	 * Id
	 * -
	 * Specifies an ID that is unique to the entire document.
	 *
	 * @Attribute(name="id")
	 * @Value(type="ID" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $id;

	/**
	 * Number
	 * -
	 * Allows a transposition to apply to only the specified staff in the part. If absent, the transposition applies to all staves in the part. Per-staff transposition is most often used in parts that represent multiple instruments.
	 *
	 * @Attribute(name="number")
	 * @Value(type="staff-number" required="false", min="1", max="infinite")
	 * @var integer
	 */
	public $number;

	/**
     * Diatonic
     *
     * @Element(name="diatonic")
     * @var Diatonic
     */
    public $diatonic;

    /**
     * Chromatic
     *
     * @Element(name="chromatic")
     * @var Chromatic
     */
    public $chromatic;

    /**
     * Octave change
     *
     * @Element(name="octave-change")
     * @var OctaveChange
     */
    public $octaveChange;

    /**
     * XDouble
     *
     * @Element(name="double")
     * @var XDouble
     */
    public $double;
}