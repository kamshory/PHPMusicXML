<?php

use MusicXML\MusicXML;

require_once "inc.lib/autoload.php";

$musicXML = new MusicXML();

try
{
    $domdoc = new DOMDocument();
    $domdoc->xmlVersion = "1.0";
    $domdoc->encoding = "UTF-8";
    $implementation = new DOMImplementation();
    $domdoc->appendChild($implementation->createDocumentType('score-partwise', "-//Recordare//DTD MusicXML 4.0 Partwise//EN", "http://www.musicxml.org/dtds/partwise.dtd"));
    $domdoc->appendChild($musicXML->getMusicXml($domdoc, '4.0'));
    $domdoc->preserveWhiteSpace = false;
    $domdoc->formatOutput = true;
    file_put_contents('lagu.xml', $domdoc->saveXML());
}
catch(Exception $e)
{
    echo $e->getMessage();  
}

