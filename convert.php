<?php

use MusicXML\MusicXML;
use MusicXML\Util\MXL;

require_once "inc.lib/autoload.php";

$musicXML = new MusicXML();
try
{
    $midi = $musicXML->loadMidi("sherina.mid");
    $mxl = new MXL();
    $xml = $musicXML->midiToMusicXml($midi, "Cinta Pertama dan Terakhir", "4.0", "xml");
    //file_put_contents("convert.mxl", $mxl->createMxl("Cinta Pertama dan Terakhir", $xml));
    file_put_contents("test.xml", $xml);
}
catch(Exception $e)
{
    echo $e->getMessage();  
}

