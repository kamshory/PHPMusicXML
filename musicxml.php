<?php




function url_check($url)
{
    $headers = @get_headers($url);
    return is_array($headers) ? preg_match('/^HTTP\\/\\d+\\.\\d+\\s+2\\d\\d\\s+.*$/', $headers[0]) : false;
}

function clean($text)
{
    return html_entity_decode(trim(str_replace(';', '-', preg_replace('/\s+/S', " ", strip_tags($text))))); // remove everything
}



function createAttribute($name, $value)
{
    $type = getAttrType($name);
    $attributeName = lcfirst(str_replace(' ', '', ucwords(str_replace('-', ' ', $name))));
    $attribute = "\t/**
\t * ".ucfirst(str_replace('-', ' ', $name))."
\t *
\t * @Attribute(name=\"$name\")
\t * @var $type
\t */
\tpublic \$$attributeName;
";
    return $attribute;
}

function getAttrType($name)
{
    $types = array(
        'dash-length'=>'float',
        'default-x'=>'float',
        'default-y'=>'float',
        'relative-x'=>'float',
        'relative-y'=>'float',
        'first-beat'=>'float',
        'space-length'=>'float',
        'elevation'=>'float',
        'tempo'=>'integer'
    );
    
    return isset($types[$name])?$types[$name]:'string';
}



function getObject($element)
{

$url = "https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/$element/";

libxml_use_internal_errors(true);


$name = basename($url);

$className = str_replace(' ', '', ucwords(str_replace('-', ' ', $name)));

$path = __DIR__.'/inc.lib/classes/MusicXML/Model/'.$className.".php";
if (!file_exists($path)) {
    echo "FILE NOT EXISTS\r\n";

    $attributes = array();
    if (url_check($url)) {
        $doc = new DomDocument;
        $doc->validateOnParse = true;
        $doc->loadHtml(file_get_contents($url));

        $containers = $doc->getElementsByTagName('main');
        $tableIndex = 0;
        $rowIndex = 0;
        foreach ($containers as $container2) {

            foreach ($container2->getElementsByTagName('table') as $container3) {
                foreach ($container3->getElementsByTagName('tr') as $tr) {

                    if ($rowIndex > 0) {
                        $cells1 = $tr->getElementsByTagName('th');
                        $cells2 = $tr->getElementsByTagName('td');
                        $name = $cells1->item(0)->nodeValue;
                        $value = $cells2->item(1)->firstChild->nodeValue;
                        $attributes[] = array('name'=>$name, 'value'=>$value);
                    }

                    $rowIndex++;
                }
            }
            $tableIndex++;
        }
    } else {
        echo 'URL not reachable!'; // Throw message when URL not be called
    }

    $attrs = array();

    
    foreach ($attributes as $attribute) {
        $attrs[] = createAttribute($attribute['name'], $attribute['value']);
    }
    
    $template = '<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * '.$className.'
 * @Xml
 * @Reference '.$url.'
 * @Data
 */
class '.$className.' extends MusicXMLWriter
{
'.implode("\r\n", $attrs).'    
}';
file_put_contents($path, $template);

}
else
{
    echo "FILE EXISTS\r\n";
}

}