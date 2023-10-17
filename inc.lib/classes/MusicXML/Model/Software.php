<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Software
 * -
 * Software is class of element &lt;software&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;encoding&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="software")
 * @ParentElement(name="encoding")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/software/
 * @Data
 */
class Software extends MusicXMLWriter
{

    /**
     * Text content
     *
     * @TextContent
     * @var string
     */
    public $textContent;
}