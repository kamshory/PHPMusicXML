<?php
namespace MusicXML\Util;

class StringUtil
{
    /**
     * Convert snake case to camel case
     *
     * @param string $input
     * @param string $glue
     * @return string
     */
    public static function camelize($input, $glue = '_')
    {
        return lcfirst(str_replace($glue, '', ucwords($input, $glue)));
    }
    
    /**
     * Convert snake case to upper camel case
     *
     * @param string $input
     * @param string $glue
     * @return string
     */
    public static function upperCamelize($input, $glue = '_')
    {
        return ucfirst(str_replace($glue, '', ucwords($input, $glue)));
    }

    /**
     * Convert camel case to snake case
     *
     * @param string $input
     * @param string $glue
     * @return string
     */
    public static function snakeize($input, $glue = '_') {
        return ltrim(
            preg_replace_callback('/[A-Z]/', function ($matches) use ($glue) {
                return $glue . strtolower($matches[0]);
            }, $input),
            $glue
        );
    }
}