<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Backup
 * @Xml
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