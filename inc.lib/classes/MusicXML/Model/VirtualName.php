<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * VirtualName
 * -
 * VirtualName is class of element &lt;virtual-name&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;virtual-instrument&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="virtual-name")
 * @ParentElement(name="virtual-instrument")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/virtual-name/
 * @Data
 */
class VirtualName extends MusicXMLWriter
{

    /**
     * Text content
     *
     * @TextContent
     * @var integer
     */
    public $textContent;
}