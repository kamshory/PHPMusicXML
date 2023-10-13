<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * CreditType
 * -
 * CreditType is class of element &lt;credit-type&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;credit&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="credit-type")
 * @ParentElement(name="credit")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/credit-type/
 * @Data
 */
class CreditType extends MusicXMLWriter
{

    /**
     * Text content
     *
     * @TextContent
     * @var string
     */
    public $textContent;
}