<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Unpitched
 * -
 * Unpitched is class of element &lt;unpitched&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;note&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="unpitched")
 * @ParentElement(name="note")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/unpitched/
 * @Data
 */
class Unpitched extends MusicXMLWriter
{

    /**
     * Display step
     *
     * @Element(name="display-step")
     * @var DisplayStep
     */
    public $displayStep;

    /**
     * Display octave
     *
     * @Element(name="display-octave")
     * @var DisplayOctave
     */
    public $displayOctave;
}