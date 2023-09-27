<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Transpose
 * @Xml
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