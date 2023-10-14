<?php

use MusicXML\MusicXMLFromMidi;
use MusicXML\Util\MXL;

require_once "inc.lib/autoload.php";

$musicXML = new MusicXMLFromMidi();
try
{
    $source = "test-2.mid";
    $result = str_replace(".mid", ".xml", $source);
    $midi = $musicXML->loadMidi($source);
    $mxl = new MXL();
    $xml = $musicXML->midiToMusicXml($midi, "Online", "4.0", MXL::FORMAT_XML);
    
    //compressed version]
    //file_put_contents("convert.mxl", $mxl->createMxl("Test", $xml));
    
    //uncompressed version
    file_put_contents($result, $xml);
}
catch(Exception $e)
{
    echo $e->getMessage();  
}

