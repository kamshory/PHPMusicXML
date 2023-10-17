<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * ScoreInstrument
 * -
 * ScoreInstrument is class of element &lt;score-instrument&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;score-part&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="score-instrument")
 * @ParentElement(name="score-part")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/score-instrument/
 * @Data
 */
class ScoreInstrument extends MusicXMLWriter
{
	/**
	 * Id
	 * -
	 * An identifier for this &lt;score-instrument&gt; that is unique to this document.
	 *
	 * @Attribute(name="id")
	 * @Value(type="ID" required="true", allowed="ANY_VALUE")
	 * @var string
	 */
	public $id;

    /**
     * Instrument name
     *
     * @Element(name="instrument-name")
     * @var InstrumentName
     */
    public $instrumentName;

    /**
     * Instrument abbreviation
     *
     * @Element(name="instrument-abbreviation")
     * @var InstrumentAbbreviation
     */
    public $instrumentAbbreviation;

    /**
     * InstrumentSound
     *
     * @Element(name="instrument-sound")
     * @var InstrumentSound
     */
    public $instrumentSound;

    /**
     * Solo
     *
     * @Element(name="solo")
     * @var Solo[]
     */
    public $solo;

    /**
     * Ensemble
     *
     * @Element(name="ensemble")
     * @var Ensemble[]
     */
    public $ensemble;

    /**
     * Virtual instrument
     *
     * @Element(name="virtual-instrument")
     * @var VirtualInstrument
     */
    public $virtualInstrument;

}