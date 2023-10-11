<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Transpose
 * @Xml
 * @Path /path/measure/attribute/transpose
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/transpose/
 * @Data
 */
class Transpose extends MusicXMLWriter
{
    /**
     * Diatonic
     * @PropertyElement
     * @var Diatonic
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