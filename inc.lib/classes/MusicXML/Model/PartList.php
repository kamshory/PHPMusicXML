<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * PartList
 * -
 * PartList is class of element &lt;part-list&gt; Open link at &#64;Referece to read full documentation.
 * Parent elements: &lt;score-partwise&gt;, &lt;score-timewise&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="part-list")
 * @ParentElement(name="score-partwise,score-timewise")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/part-list/
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