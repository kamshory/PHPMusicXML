<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Transpose
 * @Xml
 * @Path /path/measure/attribute/transpose
 * @Data
 */
class Transpose extends MusicXMLWriter
{
    /**
     * Diatonic
     * @PropertyElement
     * @var string
     */
    public $diatonic;
    
    /**
     * Chromatic
     * @PropertyElement
     * @var string
     */
    public $chromatic;
    
    /**
     * Octave change
     * @PropertyElement(name="octave-change")
     * @var string
     */
    public $octaveChange;
}