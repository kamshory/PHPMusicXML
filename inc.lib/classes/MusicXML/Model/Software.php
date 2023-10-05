<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Software
 * @Xml
 * @Path /identification/encoding/software
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/software/
 * @Data
 */
class Software extends MusicXMLWriter
{
    /**
     * Description
     *
     * @TextContent
     * @var string
     */
    public $textContent;
}