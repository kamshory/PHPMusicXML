<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Direction
 * @Xml
 * @Data
 */
class DirectionType extends MusicXMLWriter
{
    /**
     * Metronom
     *
     * @Element
     * @var string
     */
    public $metronom;
}