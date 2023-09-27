<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Backup
 * @Xml
 * @Path /path/measure/backup
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