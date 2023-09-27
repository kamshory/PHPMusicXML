<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Sound
 * @Xml
 * @Data
 */
class Sound extends MusicXMLWriter
{
    /**
     * Tempo
     *
     * @Attribute
     * @var integer
     */
    public $tempo;
}