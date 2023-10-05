<?php

use MusicXML\MusicXML;

require_once "inc.lib/autoload.php";

$musicXML = new MusicXML();
try
{
    $divisions = 6;
    $duration = 1;
    $type = $musicXML->getNoteType($duration, $divisions);
    echo "DURATION = $duration; DIVISIONS = $divisions; TYPE = $type\r\n";
}
catch(Exception $e)
{
    echo $e->getMessage();  
}

