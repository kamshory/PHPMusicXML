<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * VirtualLibrary
 * @Xml
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
