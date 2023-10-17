<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * BendAlter
 * -
 * BendAlter is class of element &lt;bend-alter&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;bend&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="bend-alter")
 * @ParentElement(name="bend")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/bend-alter/
 * @Data
 */
class BendAlter extends MusicXMLWriter
{

    /**
     * Text content
     *
     * @TextContent
     * @var float
     */
    public $textContent;
}