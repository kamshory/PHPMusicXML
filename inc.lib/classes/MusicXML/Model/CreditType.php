<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * CreditType
 * @Xml
 * @MusicXML
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