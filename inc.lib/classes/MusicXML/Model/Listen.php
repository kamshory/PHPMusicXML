<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Listen
 * @Xml
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/listen/
 * @Data
 */
class Listen extends MusicXMLWriter
{
    /**
     * Assess
     *
     * @Element(name="assess")
     * @var Assess[]
     */
    public $assess;

    /**
     * Wait
     *
     * @Element(name="wait")
     * @var Wait[]
     */
    public $wait;

    /**
     * Other listen
     *
     * @Element(name="other-listen")
     * @var OtherListen[]
     */
    public $otherListen;
    
}