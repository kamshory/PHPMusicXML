<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Miscellaneous
 * -
 * Miscellaneous is class of element &lt;miscellaneous&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;identification&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="miscellaneous")
 * @ParentElement(name="identification")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/miscellaneous/
 * @Update(date-time="2023-10-26 11:24:23")
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