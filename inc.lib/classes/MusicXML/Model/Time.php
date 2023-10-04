<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Time
 * @Xml
 * @Path /path/measure/attribute/time
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/time/
 * @Data
 */
class Time extends MusicXMLWriter
{
    /**
     * Beats
     *
     * @PropertyElement
     * @var string
     */
    public $beats;
    
    /**
     * Beat type
     *
     * @PropertyElement(name="beat-type")
     * @var string
     */
    public $beatType;
    
    /**
     * Symbol
     *
     * @PropertyElement
     * @var string
     */
    public $symbol;
}