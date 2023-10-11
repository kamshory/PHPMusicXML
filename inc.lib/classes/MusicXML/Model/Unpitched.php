<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Unpitched
 * @Xml
 * @Path /path/measure/note/Unpitched
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/unpitched/
 * @Data
 */
class Unpitched extends MusicXMLWriter
{
    /**
     * Display step
     *
     * @PropertyElement(name="display-step")
     * @var string
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