<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * MidiDevice
 * @Xml
 * @Path /path-list/score-part/midi-device
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