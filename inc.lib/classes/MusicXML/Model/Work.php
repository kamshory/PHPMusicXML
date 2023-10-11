<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Work
 * @Xml
 * @Path /work
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