<?php

use MusicXML\Properties\MeasureDivision;
use MusicXML\Properties\TimeSignature;

require_once "inc.lib/autoload.php";

$timebase = 96;
$timeSignature = new TimeSignature(array(0, 4, "4/4"));
$measureIndex = 0;

$notes = array(
    array(
        'abstime'=>0,
        'duration'=>3
    ),
    array(
        'abstime'=>12,
        'duration'=>24
    ),
    array(
        'abstime'=>48,
        'duration'=>192
    )
    
);

$measureDivision = new MeasureDivision($timebase, $notes);
echo $measureDivision->getDivision() . PHP_EOL;