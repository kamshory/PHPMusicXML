<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * ScorePart
 * -
 * ScorePart is class of element &lt;score-part&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;part-list&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="score-part")
 * @ParentElement(name="part-list")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/score-part/
 * @Data
 */
class ScorePart extends MusicXMLWriter
{
	/**
	 * Id
	 * -
	 * 
	 *
	 * @Attribute(name="id")
	 * @Value(type="ID" required="true", allowed="ANY_VALUE")
	 * @var string
	 */
	public $id;

    /**
     * Identification
     *
     * @Element(name="identification")
     * @var Identification
     */
    public $identification;

    /**
     * Part link
     *
     * @Element(name="part-link")
     * @var PartLink[]
     */
    public $partLink;

    /**
     * Part name
     *
     * @Element(name="part-name")
     * @var PartName
     */
    public $partName;

    /**
     * Part name display
     *
     * @Element(name="part-name-display")
     * @var PartNameDisplay
     */
    public $partNameDisplay;

    /**
     * Part abbreviation
     *
     * @Element(name="part-abbreviation")
     * @var PartAbbreviation
     */
    public $partAbbreviation;

    /**
     * Part abbreviation display
     *
     * @Element(name="part-abbreviation-display")
     * @var PartAbbreviationDisplay
     */
    public $partAbbreviationDisplay;

    /**
     * Group
     *
     * @Element(name="group")
     * @var Group[]
     */
    public $group;

    /**
     * Score instrument
     *
     * @Element(name="score-instrument")
     * @var ScoreInstrument[]
     */
    public $scoreInstrument;

    /**
     * Player
     *
     * @Element(name="player")
     * @var Player[]
     */
    public $player;

    /**
     * Midi device
     *
     * @Element(name="midi-device")
     * @var MidiDevice[]
     */
    public $midiDevice;

    /**
     * Midi instrument
     *
     * @Element(name="midi-instrument")
     * @var MidiInstrument[]
     */
    public $midiInstrument;

}