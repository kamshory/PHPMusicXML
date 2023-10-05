<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Notation
 * @Xml
 * @Path /path/measure/note/notations
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/notations/
 * @Data
 */
class Notations extends MusicXMLWriter
{
    /**
     * Tied list
     *
     * @Element(name="tied")
     * @var Tied[]
     */
    public $tied;
    
    /**
     * Slur list
     *
     * @Element(name="slur")
     * @var Slur[]
     */
    public $slur;
    
    /**
     * Articulations
     *
     * @Element
     * @var Articulations
     */
    public $articulations;
}