<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Pitch
 * @Xml
 * @Path /path/measure/note/pitch
 * @Data
 */
class Pitch extends MusicXMLWriter
{
    /**
     * Step
     *
     * @PropertyElement
     * @var string
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
     * @PropertyElement
     * @var integer
     */
    public $octave;
}