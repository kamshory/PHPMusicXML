<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * StaffTuning
 * -
 * StaffTuning is class of element &lt;staff-tuning&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;staff-details&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="staff-tuning")
 * @ParentElement(name="staff-details")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/staff-tuning/
 * @Data
 */
class StaffTuning extends MusicXMLWriter
{
	/**
	 * Line
	 * -
	 * Indicates the staff line for this tuning, numbered from bottom to top.
	 *
	 * @Attribute(name="line")
	 * @Value(type="staff-line" required="true", min="1", max="infinite")
	 * @var integer
	 */
	public $line;

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