<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * FrameNote
 * -
 * FrameNote is class of element &lt;frame-note&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;frame&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="frame-note")
 * @ParentElement(name="frame")
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