<?php

use MusicXML\MusicXMLFromMidi;
use MusicXML\Util\MXL;

require_once "inc.lib/autoload.php";


function fileExtension($name)
{
    $n = strrpos($name, '.');
    return ($n === false) ? '' : substr($name, $n + 1);
}


$fileList = array();

$directory = __DIR__ . "/test-files";
$items = glob($directory . '/*');
foreach ($items as $item) {
    if (is_file($item)) {
        $fileList[] = $item;
    }
}

$fileList = array(__DIR__."/test-files/1001 Car.mid");

// Iterate over directories
foreach ($fileList as $file) {

    if (strtolower(fileExtension($file)) == 'mid') {
        $musicXML = new MusicXMLFromMidi();
        try {
            $source = $file;
            $result = str_replace(".mid", ".xml", $source);
            echo "Convert file $source\r\n";
            $midi = $musicXML->loadMidi($source);
            $mxl = new MXL();
            $xml = $musicXML->midiToMusicXml($midi, "Online", "4.0", MXL::FORMAT_XML);

            //compressed version]
            //file_put_contents("convert.mxl", $mxl->createMxl("Test", $xml));

            //uncompressed version
            file_put_contents($result, $xml);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
