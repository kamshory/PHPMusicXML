<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * BeatUnitTied
 * -
 * BeatUnitTied is class of element &lt;beat-unit-tied&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;metronome&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="beat-unit-tied")
 * @ParentElement(name="metronome")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/beat-unit-tied/
 * @Data
 */
class BeatUnitTied extends MusicXMLWriter
{

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

}