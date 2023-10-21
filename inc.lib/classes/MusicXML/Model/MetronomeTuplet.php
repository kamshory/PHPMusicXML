<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * MetronomeTuplet
 * -
 * MetronomeTuplet is class of element &lt;metronome-tuplet&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;metronome-note&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="metronome-tuplet")
 * @ParentElement(name="metronome-note")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/metronome-tuplet/
 * @Data
 */
class MetronomeTuplet extends MusicXMLWriter
{
	/**
	 * Type
	 * -
	 * 
	 *
	 * @Attribute(name="type")
	 * @Value(type="start-stop" required="true", allowed="start,stop")
	 * @var string
	 */
	public $type;

	/**
	 * Bracket
	 * -
	 * 
	 *
	 * @Attribute(name="bracket")
	 * @Value(type="yes-no" required="false", allowed="yes,no")
	 * @var string
	 */
	public $bracket;

	/**
	 * Show number
	 * -
	 * 
	 *
	 * @Attribute(name="show-number")
	 * @Value(type="show-tuplet" required="false", allowed="actual,both,none")
	 * @var string
	 */
	public $showNumber;

	/**
     * Actual notes
     *
     * @Element(name="actual-notes")
     * @var ActualNotes
     */
    public $actualNotes;

    /**
     * Normal notes
     *
     * @Element(name="normal-notes")
     * @var NormalNotes
     */
    public $normalNotes;

    /**
     * Normal type
     *
     * @Element(name="normal-type")
     * @var NormalType
     */
    public $normalType;

    /**
     * Normal dot
     *
     * @Element(name="normal-dot")
     * @var NormalDot[]
     */
    public $normalDot;

}