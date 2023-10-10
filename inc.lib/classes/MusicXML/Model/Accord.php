<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Accord
 * @Xml
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/accord/
 * @Data
 */
class Accord extends MusicXMLWriter
{
	/**
	 * String
	 *
	 * @Attribute(name="string")
	 * @var string
	 */
	public $string;

    /*
     * Tuning step
     *
     * @Element(name="tuning-step")
     * @var TuningStep[]
     */
    public $tuningStep;

    /*
     * Tuning alter
     *
     * @Element(name="tuning-alter")
     * @var TuningAlter[]
     */
    public $tuningAlter;

    /*
     * Tuning octave
     *
     * @Element(name="tuning-octave")
     * @var TuningOctave[]
     */
    public $tuningOctave;

	
}