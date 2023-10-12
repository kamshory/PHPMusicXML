<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * PartList
 * @Xml(name="part-list")
 * @Data
 */
class PartList extends MusicXMLWriter
{
    /**
     * Part group
     * @Element(name="part-group")
     * @var PartGroup[]
     */
    public $partGroup;
    
    /**
     * Score part
     * @Element(name="score-part")
     * @var ScorePart[]
     */
    public $scorePart;
}