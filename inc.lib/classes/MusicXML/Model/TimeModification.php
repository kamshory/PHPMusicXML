<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * TimeModification
 * @Xml
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/time-modification/
 * @Data
 */
class TimeModification extends MusicXMLWriter
{
    /**
     * Actual notes
     *
     * @Element(name="actual-notes")
     * @var ActualNotes
     */
    public $actualNotes;

    /**
     * Normal notes
     *
     * @Element(name="normal-notes")
     * @var NormalNotes
     */
    public $normalNotes;

    /**
     * Normal type
     *
     * @Element(name="normal-type")
     * @var NormalType
     */
    public $normalType;

    /**
     * Normal dot
     *
     * @Element(name="normal-dot")
     * @var NormalDot[]
     */
    public $normalDot;

}