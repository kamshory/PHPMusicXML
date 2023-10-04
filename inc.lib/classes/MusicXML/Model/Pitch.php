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
     * @PropertyElement
     * @var integer
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