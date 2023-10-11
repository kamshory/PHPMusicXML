<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Miscellaneous
 * @Xml
 * @MusicXML
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/miscellaneous/
 * @Data
 */
class Miscellaneous extends MusicXMLWriter
{
    /**
     * Miscellaneous field
     *
     * @Element(name="miscellaneous field")
     * @var MiscellaneousField[]
     */
    public $miscellaneousField;
}