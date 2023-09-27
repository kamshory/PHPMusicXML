<?php

namespace MusicXML;

use DOMDocument;
use DOMImplementation;

class MusicXMLBase
{
    /**
     * Create new DOMDocument
     *
     * @return DOMDocument
     */
    public function getDOMDocument()
    {
        $domdoc = new DOMDocument();
        $domdoc->xmlVersion = "1.0";
        $domdoc->encoding = "UTF-8";
        $implementation = new DOMImplementation();
        $domdoc->appendChild($implementation->createDocumentType('score-partwise', "-//Recordare//DTD MusicXML 4.0 Partwise//EN", "http://www.musicxml.org/dtds/partwise.dtd"));
        $domdoc->preserveWhiteSpace = false;
        $domdoc->formatOutput = true;
        return $domdoc;
    }
}