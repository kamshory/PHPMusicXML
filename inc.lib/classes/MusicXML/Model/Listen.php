<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Listen
 * -
 * Listen is class of element &lt;listen&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;note&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="listen")
 * @ParentElement(name="note")
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