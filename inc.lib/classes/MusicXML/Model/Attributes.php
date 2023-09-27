<?php

namespace MusicXML\Model;

namespace MusicXML\Model;

use Clef;
use DateTime;
use MusicXML\MusicXMLWriter;

/**
 * Attributes
 * Source https://github.com/talobin/MusicXML-Android/blob/master/parser/src/main/java/com/talobin/music/model/Attributes.kt
 * @Xml
 * @Data
 */
class Attributes extends MusicXMLWriter
{
    
    /**
     * Division
     * @PropertyElement
     * @var string
     */
    public $divisions;

    /**
     * Staves
     * @PropertyElement
     * @var string
     */
    public $staves;

    /**
     * Time
     * @Element
     * @var DateTime
     */
    public $time;

    /**
     * Clef
     * @Element
     * @var Clef
     */
    public $clef;
}