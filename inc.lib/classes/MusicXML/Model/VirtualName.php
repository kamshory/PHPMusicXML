<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * VirtualName
 * @Xml
 * @MusicXML
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
