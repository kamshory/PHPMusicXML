<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Numeral
 * -
 * Numeral is class of element &lt;numeral&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;harmony&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="numeral")
 * @ParentElement(name="harmony")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/numeral/
 * @Data
 */
class Numeral extends MusicXMLWriter
{

    /**
     * Numeral root
     *
     * @Element(name="numeral-root")
     * @var NumeralRoot
     */
    public $numeralRoot;

    /**
     * Numeral alter
     *
     * @Element(name="numeral-alter")
     * @var NumeralAlter
     */
    public $numeralAlter;

    /**
     * Numeral key
     *
     * @Element(name="numeral-key")
     * @var NumeralKey
     */
    public $numeralKey;
}