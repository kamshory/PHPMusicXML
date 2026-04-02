<?php
require_once __DIR__ . '/inc.lib/autoload.php';

use MusicXML\MusicXMLFromMidi;

$converter = new MusicXMLFromMidi();
$midi = $converter->loadMidi('test-files/11.MID');
var_dump($midi->getTimebase());
var_dump($midi->getDurationRaw());
var_dump($midi->getDuration());

// show first notes track 1
$track = $midi->getTrack(1);
for ($i = 0; $i < min(20, count($track)); $i++) {
    echo "[$i] " . $track[$i] . "\n";
}
