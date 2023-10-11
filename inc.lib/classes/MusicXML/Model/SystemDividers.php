<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * SystemDividers
 * @Xml
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/system-dividers/
 * @Data
 */
class SystemDividers extends MusicXMLWriter
{
    /**
     * Left divider
     *
     * @Element(name="left-divider")
     * @var LeftDivider
     */
    public $leftDivider;

    /**
     * Right divider
     *
     * @Element(name="right-divider")
     * @var RightDivider
     */
    public $rightDivider;

}