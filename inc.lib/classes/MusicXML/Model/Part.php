<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Part
 * Source https://github.com/talobin/MusicXML-Android/blob/master/parser/src/main/java/com/talobin/music/model/Part.kt
 * @Xml
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