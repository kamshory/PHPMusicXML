<?php

$url = "https://github.com/w3c/musicxml/tree/gh-pages/docs/musicxml-reference/elements";
libxml_use_internal_errors(true);
$attributes = array();

$doc = new DomDocument;
$doc->validateOnParse = true;
$html = file_get_contents('element.html');
$doc->loadHtml($html);

$containers = $doc->getElementsByTagName('table');
$tableIndex = 0;
$rowIndex = 0;
foreach ($containers as $container2) {
   
    foreach ($container2->getElementsByTagName('tbody') as $container3) {
        foreach ($container3->getElementsByTagName('tr') as $tr) {

            if ($rowIndex > 0) {
                $cells1 = $tr->getElementsByTagName('td');
                $td = $cells1->item(0);
                $div1 = $td->childNodes->item(1);
                $div2 = $div1->childNodes->item(2);
                
                if(isset($div2->childNodes[1]))
                {
                    $div3 = $div2->childNodes[1]->childNodes->item(1);
                    $attributes[] = trim($div3->textContent);
                    
                }
                
                
            }

            $rowIndex++;
        }
    }
    $tableIndex++;
}
$out = "";
foreach($attributes as $attribute)
{
    $className = str_replace(' ', '', ucwords(str_replace('-', ' ', $attribute)));
    if(!file_exists(__DIR__."/inc.lib/classes/MusicXML/Model/".$className.".php"))
    {
        $out .= "<a href=\"https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/$attribute/\" target=\"_blank\">$attribute<a><br />\r\n";
    }
}

echo $out;