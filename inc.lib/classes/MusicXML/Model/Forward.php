<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Forward
 * -
 * Forward is class of element &lt;forward&gt; Open link at &#64;Referece to read full documentation.
 * Parent elements: &lt;measure&gt; (partwise), &lt;part&gt; (timewise)
 * 
 * @Xml
 * @MusicXML
 * @Element(name="forward")
 * @ParentElement(name="measure (partwise),part (timewise)")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/forward/
 * @Data
 */
class Forward extends MusicXMLWriter
{

    /**
     * Duration
     *
     * @Element(name="duration")
     * @var Duration
     */
    public $duration;

    /**
     * Footnote
     *
     * @Element(name="footnote")
     * @var Footnote
     */
    public $footnote;

    /**
     * Level
     *
     * @Element(name="level")
     * @var Level
     */
    public $level;

    /**
     * Voice
     *
     * @Element(name="voice")
     * @var Voice
     */
    public $voice;

    /**
     * Staff
     *
     * @Element(name="staff")
     * @var Staff
     */
    public $staff;

}