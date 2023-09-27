<?php

use MusicXML\MusicXML;

require_once "inc.lib/autoload.php";

$musicXML = new MusicXML();

try
{
    $midi = $musicXML->loadMidi("sherina.mid");
    $xml = $musicXML->midiToMusicXml($midi, "4.0");
}
catch(Exception $e)
{
    echo $e->getMessage();  
}

