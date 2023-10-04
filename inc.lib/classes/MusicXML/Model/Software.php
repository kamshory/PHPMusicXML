<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Software
 * @Xml
 * @Path /identification/encoding/software
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
    public $string;
}