<?php

use MusicXML\Map\DataType;

function url_check($url)
{
    $headers = @get_headers($url);
    return is_array($headers) ? preg_match('/^HTTP\\/\\d+\\.\\d+\\s+2\\d\\d\\s+.*$/', $headers[0]) : false;
}

function clean($text)
{
    return html_entity_decode(trim(str_replace(';', '-', preg_replace('/\s+/S', " ", strip_tags($text))))); // remove everything
}

function getAttributeName($name)
{
    return lcfirst(str_replace(' ', '', ucwords(str_replace(array('-', ':'), ' ', $name))));
}


function createAttribute($attribute)
{
    $name = $attribute['name'];
    $type = $attribute['type'];
    $description = htmlspecialchars($attribute['description']);
    $required = strtolower(trim($attribute['required'])) == 'yes' ? 'true':'false';
    
    $map = DataType::DATA_TYPE[$type];
    $traditionalType = $map['traditional_type'];
    $attributeName = getAttributeName($name);
    
    $allowed = isset($map['allowed_value']) && !empty($map['allowed_value']) ? $map['allowed_value'] : "ANY_VALUE";
    $min = isset($map['min']) ? $map['min'] : "-infinite";
    $max = isset($map['max']) ? $map['max'] : "infinite";
    
    if($traditionalType == 'float' || $traditionalType == 'integer')
    {
        $value = "@Value(type=\"$type\" required=\"$required\", min=\"$min\", max=\"$max\")";
    }
    else
    {
        $value = "@Value(type=\"$type\" required=\"$required\", allowed=\"$allowed\")";        
    }
    
    $attributes = "\t/**
\t * ".ucfirst(str_replace('-', ' ', $name))."
\t * -
\t * $description
\t *
\t * @Attribute(name=\"$name\")
\t * $value
\t * @var $traditionalType
\t */
\tpublic \$$attributeName;
";
    return $attributes;
}

function getAttrType($type)
{
    return DataType::DATA_TYPE[$type]['traditional_type'];
}

function getClassName($name)
{
    $className = str_replace(' ', '', ucwords(str_replace('-', ' ', $name)));
    if($className == 'Double' || $className == 'String' || $className == 'Function' || $className == 'Print')
    {
        return 'X'.$className;
    }
    return $className;
}

function parseFile($path)
{
    $lines = file($path);
    foreach($lines as $number=>$line)
    {
        $lines[$number] = rtrim($line);
    }
    $content = implode("\r\n", $lines);
    return explode("\r\n\r\n", str_replace_first("{", "{\r\n", $content));
}

function str_replace_first($search, $replace, $subject)
{
    $search = '/'.preg_quote($search, '/').'/';
    return preg_replace($search, $replace, $subject, 1);
}

function removeIfAny($parsed, $key)
{
    foreach($parsed as $idx=>$grp)
    {
        if(strpos($grp, $key) !== false)
        {
            $parsed[$idx] = "";
        }
    }
    return $parsed;
}

function getObject($element)
{

$url = "https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/$element/";

libxml_use_internal_errors(true);

$name = basename($url);
$className = getClassName($name);


$path = __DIR__.'/inc.lib/classes/MusicXML/Model/'.$className.".php";

$parsed = array();

if (file_exists($path)) 
{
    $parsed = parseFile($path);
}

$attributes = array();
$parents = array();
$ok = false;
if (url_check($url)) {
    $ok = true;
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
                    $value = $cells2->item(0)->firstChild->nodeValue;
                    $type = $cells2->item(0)->firstChild->nodeValue;
                    $required = $cells2->item(1)->firstChild->nodeValue;
                    $description = $cells2->item(2)->firstChild->nodeValue;
                    $attributes[] = array('name'=>$name, 'type'=>$type, 'value'=>$value, 'required'=>$required, 'description'=>$description);
                }

                $rowIndex++;
            }
        }
        foreach ($container2->getElementsByTagName('p') as $par)
        {
            $ptext = trim($par->nodeValue);
            if(stripos($ptext, 'Parent elements:') !== false || stripos($ptext, 'Parent element:') !== false)
            {
                foreach($par->getElementsByTagName('a') as $a)
                {
                    $text = $a->nodeValue;
                    $parents[] = trim($text);
                }
            }
        }
        $tableIndex++;
    }
} else {
    echo 'URL not reachable!'; // Throw message when URL not be called
}

if($ok)
{

$attrs = array();


foreach ($attributes as $attribute) {
    $attributeName = getAttributeName($attribute['name']);
    $key = 'public $'.$attributeName.';';
    
    $attr = createAttribute($attribute);
    $parsed = removeIfAny($parsed, $key);
    
    $attrs[] = $attr;
}
if(count($parents) > 1)
{
    $parentElement = 'Parent elements: '.implode(', ', $parents);
}
else if(count($parents) == 1)
{
    $parentElement = 'Parent element: '.implode(', ', $parents);

}
else
{
    $parentElement = 'Parent element: none';
}

$pel = implode(',', $parents);

if(strpos($pel, '<') !== false)
{
    $parentElementAnnotation = "\r\n".' * @ParentElement(name="'.str_replace(array('<', '>'), '', $pel).'")';
}
else
{
    $parentElementAnnotation = "";
}

if(!file_exists($path))
{
    echo "FILE NOT EXISTS\r\n";
    $template = '<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * '.$className.'
 * -
 * '.$className.' is class of element &lt;'.$element.'&gt; Open link at &#64;Referece to read full documentation.
 * '.htmlspecialchars($parentElement).'
 * 
 * @Xml
 * @MusicXML
 * @Element(name="'.$element.'")'.$parentElementAnnotation.'
 * @Reference '.$url.'
 * @Data
 */
class '.$className.' extends MusicXMLWriter
{
'.implode("\r\n", $attrs).'    
}';
$content = $template;
$content = trim($content, " \t\r\n ");
if(substr($content, strlen($content) - 1) != '}')
{
    $content .= "\r\n}";
}
file_put_contents($path, $content);

}
else
{
    $fromFile = implode("\r\n\r\n", $parsed);
    $fromFile = str_replace_first("{", "{\r\n".implode("\r\n", $attrs), $fromFile);
    $template = '<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * '.$className.'
 * -
 * '.$className.' is class of element &lt;'.$element.'&gt; Open link at &#64;Referece to read full documentation.
 * '.htmlspecialchars($parentElement).'
 * 
 * @Xml
 * @MusicXML
 * @Element(name="'.$element.'")'.$parentElementAnnotation.'
 * @Reference '.$url.'
 * @Data
 */
class '.$className.' extends MusicXMLWriter
';

    $offset = strpos($fromFile, "{", 0);
    while(stripos($fromFile, "\r\n\r\n\r\n") !== false)
    {
        $fromFile = str_replace("\r\n\r\n\r\n", "\r\n\r\n", $fromFile);
    }

    $content = $template.substr($fromFile, $offset)."";
    $content = trim($content, " \t\r\n ");
    if(substr($content, strlen($content) - 1) != '}')
    {
        $content .= "\r\n}";
    }


    file_put_contents($path, $content);
}


}
}