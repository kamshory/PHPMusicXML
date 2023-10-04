<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Backup
 * @Xml
 * @Path /path/measure/backup
 * @Referece https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/backup/
 * @Data
 */
class Backup extends MusicXMLWriter
{
    /**
     * Duration
     * @Attribute
     * @var integer
     */
    public $duration;
}