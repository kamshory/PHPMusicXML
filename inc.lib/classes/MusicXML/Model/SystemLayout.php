<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * SystemLayout
 * -
 * SystemLayout is class of element &lt;system-layout&gt; Open link at &#64;Referece to read full documentation.
 * Parent elements: &lt;defaults&gt;, &lt;print&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="system-layout")
 * @ParentElement(name="defaults,print")
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