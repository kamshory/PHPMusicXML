<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * PartPartwise
 * @Xml
 * @MusicXML
 * @Path /part
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/part-partwise/
 * @Data
 */
class PartPartwise extends MusicXMLWriter
{
    /**
     * ID
     *
     * @Attribute
     * @var string
     */
    public $id;
    
    /**
     * MeasurePartwise list
     *
     * @Element(name="measure")
     * @var MeasurePartwise[]
     */
    public $measure;
}