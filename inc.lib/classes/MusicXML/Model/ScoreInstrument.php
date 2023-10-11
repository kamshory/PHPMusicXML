<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * ScoreInstrument
 * @Xml
 * @Path /path-list/score-part/score-instrument
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/score-instrument/
 * @Data
 */
class ScoreInstrument extends MusicXMLWriter
{
    /**
     * ID
     *
     * @Attribute
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
     * @PropertyElement(name="instrument-sound")
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