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

$fileList = array(__DIR__."/test-files/test-4.mid");

// Create a single instance of the converter
$musicXMLConverter = new MusicXMLFromMidi();

// Iterate over the file list
foreach ($fileList as $file) {

    if (strtolower(fileExtension($file)) == 'mid') {
        try {
            $source = $file;
            $result = str_replace(".mid", ".xml", $source);
            echo "Convert file $source\r\n";
            $midi = $musicXMLConverter->loadMidi($source); // This returns a MidiMeasure object
            $xml = $musicXMLConverter->midiToMusicXml($midi, "Online", "4.0", MXL::FORMAT_XML);

            // To create a compressed .mxl file, you can use:
            // $mxl = new MXL();
            // file_put_contents(str_replace(".mid", ".mxl", $source), $mxl->xmlToMxl("Online", $xml));

            //uncompressed version
            echo $result."\r\n";
            file_put_contents($result, $xml);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
