<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Work
 * -
 * Work is class of element &lt;work&gt; Open link at &#64;Referece to read full documentation.
 * Parent elements: &lt;score-partwise&gt;, &lt;score-timewise&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="work")
 * @ParentElement(name="score-partwise,score-timewise")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/work/
 * @Data
 */
class Work extends MusicXMLWriter
{

    /**
     * Work number
     * @Element(name="work-number")
     * @var WorkNumber
     */
    public $workNumber;

    /**
     * Work title
     * @Element(name="work-title")
     * @var WorkTitle
     */
    public $workTitle;

    /**
     * Opus
     * @Element
     * @var Opus
     */
    public $opus;
}