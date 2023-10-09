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

<assess>
<wait>
<other-listen>

';
$elementList = str_replace(array('<', '>'), '', $elementList);

$elements = explode("\r\n", $elementList);
$props = array();
foreach($elements as $element)
{
    if(!empty($element))
    {
        getObject($element);
        $className = getClassName($element);
        $description = getDescription($element);
        $propertyName = getPropertyName($element);
        $prop = "\t/*\r\n"
        ."\t * ".$description."\r\n"
        ."\t *\r\n"
        ."\t * @Element(name=\"".$element."\")\r\n"
        ."\t * @var $className"."["."]\r\n"
        ."\t */\r\n"
        ."\tpublic \$".$propertyName.";\r\n\r\n";
        $props[] = $prop;
    }
}

echo implode("", $props);

