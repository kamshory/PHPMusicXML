<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * SystemMargins
 * @Xml
 * @MusicXML
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