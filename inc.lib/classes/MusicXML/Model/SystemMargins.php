<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * SystemMargins
 * -
 * SystemMargins is class of element &lt;system-margins&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;system-layout&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="system-margins")
 * @ParentElement(name="system-layout")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/system-margins/
 * @Data
 */
class SystemMargins extends MusicXMLWriter
{

    /**
     * Left margin
     *
     * @Element(name="left-margin")
     * @var LeftMargin
     */
    public $leftMargin;

    /**
     * Right margin
     *
     * @Element(name="right-margin")
     * @var RightMargin
     */
    public $rightMargin;

}