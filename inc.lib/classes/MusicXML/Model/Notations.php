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
     * @Element
     * @var Tied[]
     */
    public $tied;
    
    /**
     * Slur list
     *
     * @Element
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
    
    /**
     * Footnote
     *
     * @Element
     * @var Footnote
     */
    public $footnote;
    
    /**
     * Level
     *
     * @Element
     * @var Level
     */
    public $level;
    
    /**
     * Tuplet list
     *
     * @Element
     * @var Tuplet[]
     */
    public $tuplet;
    
    /**
     * Glissando
     *
     * @Element
     * @var Glissando
     */
    public $glissando;
}