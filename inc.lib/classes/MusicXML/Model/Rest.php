<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Rest
 * @Xml
 * @Path /path/measure/note/rest
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/rest/
 * @Data
 */
class Rest extends MusicXMLWriter
{
    /**
     * Measure
     *
     * @Attribute(name="measure")
     * @var string
     */
    public $measure;
    
    /**
     * Display step
     *
     * @PropertyElement(name="display-step")
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