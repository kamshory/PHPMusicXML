<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * MetronomeNote
 * @Xml
 * @MusicXML
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/metronome-note/
 * @Data
 */
class MetronomeNote extends MusicXMLWriter
{
    /**
     * Metronome type
     *
     * @Element(name="metronome-type")
     * @var MetronomeType
     */
    public $metronomeType;

    /**
     * Metronome dot
     *
     * @Element(name="metronome-dot") 
     * @var MetronomeDot[]
     */
    public $metronomeDot;

    /**
     * Metronome beam
     *
     * @Element(name="metronome-beam")
     * @var MetronomeBeam[]
     */
    public $metronomeBeam;

    /**
     * Metronome tied
     *
     * @Element(name="metronome-tied")
     * @var MetronomeTied
     */
    public $metronomeTied;

    /**
     * Metronome tuplet
     *
     * @Element(name="metronome-tuplet")
     * @var MetronomeTuplet
     */
    public $metronomeTuplet;

}