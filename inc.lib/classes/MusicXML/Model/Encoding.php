<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Encoding
 * @Xml
 * @Path /identification/encoding
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/encoding/
 * @Data
 */
class Encoding extends MusicXMLWriter
{
    /**
     * Software list
     * @Element(name="software")
     * @var Software[]
     */
    public $softwareList;
    
    /**
     * Encoding date
     * @PropertyElement(name="encoding-date")
     * @var string
     */
    public $encodingDate;
    
    /**
     * Supports
     * @PropertyElement
     * @var Supports
     */
    public $supports;
}