<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Software
 * Source https://github.com/talobin/MusicXML-Android/blob/master/parser/src/main/java/com/talobin/music/model/Software.kt
 * @Xml
 * @Path /identification/encoding/softeare
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
    public $description;
}