<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Part
 * @Xml
 * @Path /part
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/part-partwise/
 * @Data
 */
class Part extends MusicXMLWriter
{
    /**
     * ID
     *
     * @Attribute
     * @var string
     */
    public $id;
    
    /**
     * Measure list
     *
     * @Element(name="measure")
     * @var Measure[]
     */
    public $measureList;
}