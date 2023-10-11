<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * SystemLayout
 * @Xml
 * @MusicXML
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/system-layout/
 * @Data
 */
class SystemLayout extends MusicXMLWriter
{
    /**
     * System margins
     *
     * @Element(name="system-margins")
     * @var SystemMargins
     */
    public $systemMargins;

    /**
     * System distance
     *
     * @Element(name="system-distance")
     * @var SystemDistance
     */
    public $systemDistance;

    /**
     * Top system distance
     *
     * @Element(name="top-system-distance")
     * @var TopSystemDistance
     */
    public $topSystemDistance;

    /**
     * System dividers
     *
     * @Element(name="system-dividers")
     * @var SystemDividers
     */
    public $systemDividers;

}