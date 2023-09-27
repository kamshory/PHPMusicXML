<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * PartList
 * Source https://github.com/talobin/MusicXML-Android/blob/master/parser/src/main/java/com/talobin/music/model/PartList.kt
 * @Xml(name="part-list")
 * @Path /path-list
 * @Data
 */
class PartList extends MusicXMLWriter
{
    /**
     * Part group
     * @Element(name="part-group")
     * @var PartGroup[]
     */
    public $partGroupList;
    
    /**
     * Score part
     * @Element(name="score-part")
     * @var ScorePart[]
     */
    public $scorePartList;
}