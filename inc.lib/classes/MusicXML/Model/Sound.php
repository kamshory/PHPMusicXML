<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Sound
 * @Xml
 * @Path /path/measure/direction/sound
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