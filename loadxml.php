<?php

use MusicXML\MusicXML;

require_once "inc.lib/autoload.php";

$musicXML = new MusicXML();
try
{
    $midi = $musicXML->loadXml("convert.xml");
    
}
catch(Exception $e)
{
    echo $e->getMessage();  
}

