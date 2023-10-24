<?php

namespace MusicXML\Util;

use MusicXML\Exceptions\ZeroArgumentException;
use ReflectionClass;
use ReflectionMethod;
use ReflectionProperty;

class PicoAnnotationParser
{
    /**
     * Raw docblock
     * @var string
     */
    private $rawDocBlock;

    /**
     * Parameters
     * @var array
     */
    private $parameters;

    /**
     * Key pattern
     *
     * @var string
     */
    private $keyPattern = "[A-z0-9\_\-]+";

    /**
     * End pattern
     *
     * @var string
     */
    private $endPattern = "[ ]*(?:@|\r\n|\n)";

    /**
     * Parsed
     *
     * @var boolean
     */
    private $parsedAll = false;

    /**
     * Reflection
     * @var ReflectionClass|ReflectionMethod|ReflectionProperty
     */
    private $reflection;
    
    const METHOD = "method";
    const PROPERTY = "property";

    /**
     * Constructor
     */
    public function __construct()
    {
        $arguments = func_get_args();
        $count = count($arguments);

        // get reflection from class or class/method
        // (depends on constructor arguments)
        if ($count === 0) {
            throw new ZeroArgumentException("No zero argument constructor allowed");
        } else if ($count === 1) {
            $reflection = new ReflectionClass($arguments[0]);
        } else {
            $type = $count === 3 ? $arguments[2] : self::METHOD;

            if ($type === self::METHOD) {
                $reflection = new ReflectionMethod($arguments[0], $arguments[1]);
            } else if ($type === self::PROPERTY) {
                $reflection = new ReflectionProperty($arguments[0], $arguments[1]);
            }
        }
        $this->reflection = $reflection;
        $this->rawDocBlock = $reflection->getDocComment();
        $this->parameters = array();
    }

    /**
     * Get properties
     *
     * @return array
     */
    public function getProperties()
    {
        return $this->reflection->getProperties();
    }

    /**
     * Parse single annotation
     *
     * @param string $key
     * @return array
     */
    private function parseSingle($key)
    {
        $ret = null;
        if (isset($this->parameters[$key])) {
            $ret = $this->parameters[$key];
        } else {
            if (preg_match("/@" . preg_quote($key) . $this->endPattern . "/", $this->rawDocBlock, $match)) {
                $ret = true;
            } else {
                preg_match_all("/@" . preg_quote($key) . "(.*)" . $this->endPattern . "/U", $this->rawDocBlock, $matches);
                $size = sizeof($matches[1]);

                // not found
                if ($size === 0) {
                    $ret = null;
                }
                // found one, save as scalar
                elseif ($size === 1) {
                    $ret = $this->parseValue($matches[1][0]);
                }
                // found many, save as array
                else {
                    $this->parameters[$key] = array();
                    foreach ($matches[1] as $elem) {
                        $this->parameters[$key][] = $this->parseValue($elem);
                    }
                    $ret = $this->parameters[$key];
                }
            }
        }
        return $ret;
    }

    /**
     * Parse annotation
     *
     * @return void
     */
    private function parse()
    {
        $pattern = "/@(?=(.*)" . $this->endPattern . ")/U";

        preg_match_all($pattern, $this->rawDocBlock, $matches);

        foreach ($matches[1] as $rawParameter) {
            if (preg_match("/^(" . $this->keyPattern . ")(.*)$/", $rawParameter, $match)) {
                $parsedValue = $this->parseValue($match[2]);
                if (isset($this->parameters[$match[1]])) {
                    $this->parameters[$match[1]] = array_merge((array)$this->parameters[$match[1]], (array)$parsedValue);
                } else {
                    $this->parameters[$match[1]] = $parsedValue;
                }
            } else if (preg_match("/^" . $this->keyPattern . "$/", $rawParameter, $match)) {
                $this->parameters[$rawParameter] = true;
            } else {
                $this->parameters[$rawParameter] = null;
            }
        }
    }

    /**
     * Get declared variables
     *
     * @param string $name
     * @return string[]
     */
    public function getVariableDeclarations($name)
    {
        $declarations = (array)$this->getParameter($name);
        foreach ($declarations as &$declaration) {
            $declaration = $this->parseVariableDeclaration($declaration, $name);
        }
        return $declarations;
    }

    /**
     * Get declared variable
     *
     * @param mixed $declaration
     * @param string $name
     * @return string[]
     */
    private function parseVariableDeclaration($declaration, $name)
    {
        $type = gettype($declaration);

        if ($type !== 'string') {
            throw new \InvalidArgumentException(
                "Raw declaration must be string, $type given. Key='$name'."
            );
        }

        if (strlen($declaration) === 0) {
            throw new \InvalidArgumentException(
                "Raw declaration cannot have zero length. Key='$name'."
            );
        }

        $declaration = explode(" ", $declaration);
        if (sizeof($declaration) == 1) {
            // string is default type
            array_unshift($declaration, "string");
        }

        // take first two as type and name
        $declaration = array(
            'type' => $declaration[0],
            'name' => $declaration[1]
        );

        return $declaration;
    }

    /**
     * Parse value
     *
     * @param string $originalValue
     * @return array
     */
    private function parseValue($originalValue)
    {
        if ($originalValue && $originalValue !== 'null') {
            // try to json decode, if cannot then store as string
            if (($json = json_decode($originalValue, true)) === null) {
                $value = $originalValue;
            } else {
                $value = $json;
            }
        } else {
            $value = null;
        }
        return $value;
    }

    /**
     * Get parameters
     * 
     * @return array
     */
    public function getParameters()
    {
        if (!$this->parsedAll) {
            $this->parse();
            $this->parsedAll = true;
        }
        return $this->parameters;
    }

    /**
     * Get parameter
     *
     * @param string $key
     * @return array
     */
    public function getParameter($key)
    {
        return $this->parseSingle($key);
    }

    /**
     * Parse parameters. Note that all numeric attributes will be started with underscore (_). Do not use it as is
     *
     * @param string $queryString
     * @return string[]
     */
    public function parseKeyValue($queryString)
    {
        // For every modification, please test regular expression with https://regex101.com/
    
        // parse attributes with quotes
        $regex1 = '/([_\-\w+]+)\=\"([a-zA-Z0-9\-\+ _,.\(\)\{\}\`\~\!\@\#\$\%\^\*\\\|\<\>\[\]\/&%?=:;\'\t\r\n|\r|\n]+)\"/m'; // NOSONAR
        preg_match_all($regex1, $queryString, $matches1);
        $pair1 = array_combine($matches1[1], $matches1[2]);
        
        // parse attributes without quotes
        $regex2 = '/([_\-\w+]+)\=([a-zA-Z0-9._]+)/m'; // NOSONAR
        preg_match_all($regex2, $queryString, $matches2);
        $pair2 = array_combine($matches2[1], $matches2[2]);
        
        // merge $pair1 and $pair2 into $pair3
        $pair3 = array_merge($pair1, $pair2);
        
        // parse attributes without any value
        $regex3 = '/([\w\=\-\_"]+)/m'; // NOSONAR
        preg_match_all($regex3, $queryString, $matches3);
        
        $pair4 = array();
        if(isset($matches3) && isset($matches3[0]) && is_array($matches3[0]))
        {
            $keys = array_keys($pair3);
            foreach($matches3[0] as $val)
            {
                if(stripos($val, '=') === false && stripos($val, '"') === false && stripos($val, "'") === false && !in_array($val, $keys))
                {
                    if(is_numeric($val))
                    {
                        // prepend attribute with underscore due unexpected array key
                        $pair4["_".$val] = true;
                    }
                    else
                    {
                        $pair4[$val] = true;
                    }
                }
            }
        }
        
        // merge $pair3 and $pair4 into result
        return array_merge($pair3, $pair4);
    }
}
