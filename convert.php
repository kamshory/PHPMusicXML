<?php

use MusicXML\MusicXML;

require_once "inc.lib/autoload.php";

$musicXML = new MusicXML();
try
{
    $midi = $musicXML->loadMidi("sherina.mid");
    $xml = $musicXML->midiToMusicXml($midi, "Cinta Pertama dan Terakhir", "4.0");
    file_put_contents("convert.xml", $xml);
}
catch(Exception $e)
{
    echo $e->getMessage();  
}

