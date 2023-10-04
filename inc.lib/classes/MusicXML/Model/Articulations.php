<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Articulations
 * @Xml
 * @Path /path/measure/note/notation/articulations
 * @Referece https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/articulations/
 * @Data
 */
class Articulations extends MusicXMLWriter
{
    /**
     * @Element 
     * @var Staccato[]
     */
    public $staccato;
}