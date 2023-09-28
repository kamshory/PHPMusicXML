<?php

use MusicXML\MusicXML;

require_once "inc.lib/autoload.php";

$musicXML = new MusicXML();
try
{
    $musicXML->getIsntrumentSound(1, 1, 'requinto guitar');
}
catch(Exception $e)
{
    echo $e->getMessage();  
}

