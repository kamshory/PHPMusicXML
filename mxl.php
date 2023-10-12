<?php

use MusicXML\Util\MXL;

require_once "inc.lib/autoload.php";

$mxl = new MXL();
echo $mxl->getContainer('apa.musicxml', 'application/vnd.recordare.musicxml', '1.0', 'UTF-8')->saveXML();