<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Numeral
 * @Xml
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/numeral/
 * @Data
 */
class Numeral extends MusicXMLWriter
{
    /*
     * Numeral root
     *
     * @Element(name="numeral-root")
     * @var NumeralRoot
     */
    public $numeralRoot;

    /*
     * Numeral alter
     *
     * @Element(name="numeral-alter")
     * @var NumeralAlter
     */
    public $numeralAlter;

    /*
     * Numeral key
     *
     * @Element(name="numeral-key")
     * @var NumeralKey
     */
    public $numeralKey;
}