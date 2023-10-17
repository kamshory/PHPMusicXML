<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Listening
 * -
 * Listening is class of element &lt;listening&gt; Open link at &#64;Referece to read full documentation.
 * Parent elements: &lt;direction&gt;, &lt;measure&gt; (partwise), &lt;part&gt; (timewise)
 * 
 * @Xml
 * @MusicXML
 * @Element(name="listening")
 * @ParentElement(name="direction,measure (partwise),part (timewise)")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/listening/
 * @Data
 */
class Listening extends MusicXMLWriter
{

    /**
     * Sync
     *
     * @Element(name="sync")
     * @var Sync
     */
    public $sync;

    /**
     * Other listening
     *
     * @Element(name="other-listening")
     * @var OtherListening
     */
    public $otherListening;

    /**
     * Offset
     *
     * @Element(name="offset")
     * @var Offset
     */
    public $offset;

}