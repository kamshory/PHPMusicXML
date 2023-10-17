<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * VirtualLibrary
 * -
 * VirtualLibrary is class of element &lt;virtual-library&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;virtual-instrument&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="virtual-library")
 * @ParentElement(name="virtual-instrument")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/virtual-library/
 * @Data
 */
class VirtualLibrary extends MusicXMLWriter
{

    /**
     * Text content
     *
     * @TextContent
     * @var integer
     */
    public $textContent;
}