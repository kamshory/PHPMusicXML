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
     * @PropertyElement(name="work-number")
     * @var string
     */
    public $workNumber;
    
    /**
     * Work title
     * @PropertyElement(name="work-title")
     * @var string
     */
    public $workTitle;
    
    /**
     * Opus
     * @Element
     * @var Opus
     */
    public $opus;
}