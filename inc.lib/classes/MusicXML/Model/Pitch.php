<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Pitch
 * @Xml
 * @MusicXML
 * @Path /path/measure/note/pitch
 * @Data
 */
class Pitch extends MusicXMLWriter
{
    /**
     * Step
     *
     * @Element
     * @var Step
     */
    public $step;
    
    /**
     * Alter
     *
     * @Element
     * @var Alter
     */
    public $alter;
    
    /**
     * Octave
     *
     * @Element
     * @var Octave
     */
    public $octave;
}