<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * StaffTuning
 * @Xml
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/staff-tuning/
 * @Data
 */
class StaffTuning extends MusicXMLWriter
{
	/**
	 * Line
	 *
	 * @Attribute(name="line")
	 * @var string
	 */
	public $line;
    
    /*
     * Tuning step
     *
     * @Element(name="tuning-step")
     * @var TuningStep
     */
    public $tuningStep;

    /*
     * Tuning alter
     *
     * @Element(name="tuning-alter")
     * @var TuningAlter
     */
    public $tuningAlter;

    /*
     * Tuning octave
     *
     * @Element(name="tuning-octave")
     * @var TuningOctave
     */
    public $tuningOctave;

}