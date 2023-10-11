<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * BeatUnitTied
 * @Xml
 * @MusicXML
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