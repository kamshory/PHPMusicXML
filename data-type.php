<?php

use MusicXML\Map\DataType;

require_once "inc.lib/autoload.php";

$dataType = DataType::DATA_TYPE;
$array = array();
foreach($dataType as $index=>$data)
{
    $url = 'https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/'.$index.'/';
    $array[] = '"'.$index.'"=>array("traditional_type"=>"'.$data['traditional_type'].'", "filter"=>"", "allowed_value"=>null), // Reference '.$url;
}
echo "    const DATA_TYPE = array(\r\n\t\t".implode("\r\n\t", $array)."\r\n\t);";
