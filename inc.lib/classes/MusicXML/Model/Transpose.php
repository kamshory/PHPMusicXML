<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Transpose
 * @Xml
 * @MusicXML
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/transpose/
 * @Data
 */
class Transpose extends MusicXMLWriter
{
	/**
	 * Id
	 *
	 * @Attribute(name="id")
	 * @var string
	 */
	public $id;

	/**
	 * Number
	 *
	 * @Attribute(name="number")
	 * @var string
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
     * Double
     *
     * @Element(name="double")
     * @var Double
     */
    public $double;
}