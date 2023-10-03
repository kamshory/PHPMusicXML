<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * MidiDevice
 * @Xml
 * @Path /path-list/score-part/midi-device
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/midi-device/
 * @Data
 */
class MidiDevice extends MusicXMLWriter
{
    /**
     * ID
     *
     * @Attribute
     * @var string
     */
    public $id;
    
    /**
     * Port
     *
     * @Attribute
     * @var integer
     */
    public $port;
    
    /**
     * Description
     *
     * @TextContent
     * @var String
     */
    public $description = "";
    
}