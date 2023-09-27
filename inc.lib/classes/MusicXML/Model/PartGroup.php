<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * PartGroup
 * Source https://github.com/talobin/MusicXML-Android/blob/master/parser/src/main/java/com/talobin/music/model/PartGroup.kt
 * @Xml
 * @Path /path-list/part-group
 * @Data
 */
class PartGroup extends MusicXMLWriter
{
    /**
     * Number
     *
     * @Attribute
     * @var string
     */
    public $number;
    
    /**
     * Type
     *
     * @Attribute
     * @var string
     */
    public $type;
    
    /**
     * Measure list
     *
     * @PropertyElement(name="group-symbol")
     * @var string
     */
    public $groupSymbol;
}