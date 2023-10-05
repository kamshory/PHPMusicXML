<?php

use MusicXML\MusicXML;
use MusicXML\Util\MXL;

require_once "inc.lib/autoload.php";

$musicXML = new MusicXML();
try
{
    $midi = $musicXML->loadMidi("test.mid");
    $mxl = new MXL();
    $xml = $musicXML->midiToMusicXml($midi, "Test", "4.0", MXL::FORMAT_MXL);
    
    //compressed version]
    //file_put_contents("convert.mxl", $mxl->createMxl("Test", $xml));
    
    //uncompressed version
    file_put_contents("test.xml", $xml);
}
catch(Exception $e)
{
    echo $e->getMessage();  
}

