<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Listening
 * @Xml
 * @MusicXML
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