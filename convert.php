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

// Command-line usage:
// php convert.php input.mid            -> output: input.xml
// php convert.php input.mid output.xml -> output file explicitly
// php convert.php --dir=test-files     -> convert all .mid files in folder
$input = isset($argv[1]) ? $argv[1] : null;
$output = isset($argv[2]) ? $argv[2] : null;

if ($input && strpos($input, '--dir=') === 0) {
    $directory = substr($input, 6);
    if (!is_dir($directory)) {
        fwrite(STDERR, "Directory not found: $directory\n");
        exit(1);
    }
    $items = glob(rtrim($directory, '/\\') . '/*.mid');
    foreach ($items as $item) {
        if (is_file($item)) {
            $fileList[] = $item;
        }
    }
} elseif ($input && strtolower(pathinfo($input, PATHINFO_EXTENSION)) === 'mid') {
    $fileList[] = $input;
} else {
    $directory = __DIR__ . "/test-files";
    $items = glob($directory . '/*.mid');
    foreach ($items as $item) {
        if (is_file($item)) {
            $fileList[] = $item;
        }
    }
}

// Create a single instance of the converter
$musicXMLConverter = new MusicXMLFromMidi();

// Iterate over the file list
foreach ($fileList as $file) {

    if (strtolower(fileExtension($file)) == 'mid') {
        try {
            $source = $file;
            if ($output) {
                $result = $output;
            } else {
                $result = preg_replace('/\.mid$/i', '.xml', $source);
            }
            echo "Convert file $source -> $result\n";

            $midi = $musicXMLConverter->loadMidi($source); // This returns a MidiMeasure object
            $xml = $musicXMLConverter->midiToMusicXml($midi, basename($source, '.mid'), '4.0', MXL::FORMAT_XML);

            file_put_contents($result, $xml);
        } catch (Exception $e) {
            echo "Error converting $file: " . $e->getMessage() . "\n";
        }
    }
}

