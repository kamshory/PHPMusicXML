<?php

use MusicXML\MusicXML;

require_once "inc.lib/autoload.php";

$musicXML = new MusicXML();

try
{
    $domdoc = $musicXML->getDOMDocument();
    $domdoc->appendChild($musicXML->getMusicXml($domdoc, '4.0'));
    file_put_contents('lagu.xml', $domdoc->saveXML());
}
catch(Exception $e)
{
    echo $e->getMessage();  
}

