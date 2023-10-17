<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * MetronomeNote
 * -
 * MetronomeNote is class of element &lt;metronome-note&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;metronome&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="metronome-note")
 * @ParentElement(name="metronome")
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