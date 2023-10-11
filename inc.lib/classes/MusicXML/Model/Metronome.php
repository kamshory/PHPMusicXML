<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Metronome
 * @Xml
 * @MusicXML
 * @Path /path/measure/direction/direction-type/metronome
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/metronome/
 * @Data
 */
class Metronome extends MusicXMLWriter
{
    /**
     * Parentheses
     *
     * @Attribute
     * @var string
     */
    public $parentheses;

    /**
     * Direction type
     *
     * @PropertyElement(name="direction-type")
     * @var DirectionType
     */
    public $directionType;

    /**
     * Beat unit
     *
     * @Element(name="beat-unit")
     * @var BeatUnit
     */
    public $beatUnit;

    /**
     * Beat unit dot
     *
     * @Element(name="beat-unit-dot")
     * @var BeatUnitDot[]
     */
    public $beatUnitDot;

    /**
     * Beat unit tied
     *
     * @Element(name="beat-unit-tied")
     * @var BeatUnitTied[]
     */
    public $beatUnitTied;

    /**
     * Per minute
     *
     * @Element(name="per-minute")
     * @var PerMinute
     */
    public $perMinute;

    /**
     * Metronome arrows
     *
     * @Element(name="metronome-arrows")
     * @var MetronomeArrows
     */
    public $metronomeArrows;

    /**
     * Metronome note
     *
     * @Element(name="metronome-note")
     * @var MetronomeNote[]
     */
    public $metronomeNote;

    /**
     * Metronome relation
     *
     * @Element(name="metronome-relation")
     * @var MetronomeRelation
     */
    public $metronomeRelation;

}