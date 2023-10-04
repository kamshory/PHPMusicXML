<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Sound
 * @Xml
 * @Path /path/measure/direction/sound
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/sound/
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