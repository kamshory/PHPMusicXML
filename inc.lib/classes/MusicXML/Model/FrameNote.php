<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * FrameNote
 * @Xml
 * @MusicXML
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/frame-note/
 * @Data
 */
class FrameNote extends MusicXMLWriter
{
    /**
     * XString
     *
     * @Element(name="string")
     * @var XString
     */
    public $string;

    /**
     * Fret
     *
     * @Element(name="fret")
     * @var Fret
     */
    public $fret;

    /**
     * Fingering
     *
     * @Element(name="fingering")
     * @var Fingering
     */
    public $fingering;

    /**
     * Barre
     *
     * @Element(name="barre")
     * @var Barre
     */
    public $barre;

}