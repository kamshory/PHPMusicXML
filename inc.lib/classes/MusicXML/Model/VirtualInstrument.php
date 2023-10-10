<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * VirtualInstrument
 * @Xml
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/virtual-instrument/
 * @Data
 */
class VirtualInstrument extends MusicXMLWriter
{
    /*
     * Virtual library
     *
     * @Element(name="virtual-library")
     * @var VirtualLibrary
     */
    public $virtualLibrary;

    /*
     * Virtual name
     *
     * @Element(name="virtual-name")
     * @var VirtualName
     */
    public $virtualName;


}