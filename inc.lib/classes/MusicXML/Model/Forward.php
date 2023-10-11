<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Forward
 * @Xml
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