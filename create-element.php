<?php

require_once __DIR__ . "/musicxml.php";

function getDescription($name)
{
    return ucfirst(str_replace('-', ' ', $name));
}
function getClassName($name)
{
    return str_replace(' ', '', ucwords(str_replace('-', ' ', $name)));
}
function getPropertyName($name)
{
    return lcfirst(str_replace(' ', '', ucwords(str_replace('-', ' ', $name))));
}

$elementList = '
<rehearsal>[]
<segno>[]
<coda>[]
<words>[]
<symbol>[]
<wedge>
<dynamics>[]
<dashes>
<bracket>
<pedal>
<metronome>
<octave-shift>
<harp-pedals>
<damp>
<damp-all>
<eyeglasses>
<string-mute>
<scordatura>
<image>
<principal-voice>
<percussion>[]
<accordion-registration>
<staff-divide>
<other-direction>
';
$elementList = str_replace(array('<', '>'), '', $elementList);

$elements = explode("\r\n", $elementList);
$props = array();
foreach($elements as $elementFull)
{
    $element = str_replace(array('[', ']'), '', $elementFull);
    
    if(!empty($element))
    {
        
        $isArray = stripos($elementFull, '[') !== false;
        $mark = $isArray ? '[]' : '';
        
        getObject($element);
        $className = getClassName($element);
        $description = getDescription($element);
        $propertyName = getPropertyName($element);
        $prop = "\t/*\r\n"
        ."\t * ".$description."\r\n"
        ."\t *\r\n"
        ."\t * @Element(name=\"".$element."\")\r\n"
        ."\t * @var $className"."$mark\r\n"
        ."\t */\r\n"
        ."\tpublic \$".$propertyName.";\r\n\r\n";
        $props[] = $prop;
    }
}

echo implode("", $props);

