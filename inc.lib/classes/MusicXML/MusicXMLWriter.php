<?php

namespace MusicXML;

use DateTime;
use DOMNode;
use MusicXML\Map\ModelParser;
use MusicXML\Map\NodeType;
use MusicXML\Util\PicoAnnotationParser;
use ReflectionClass;
use stdClass;

/**
 * MusicXMLWrtiter to write MusicXML document using annotation
 * See https://github.com/kamshory/PHPMusicXML
 */
class MusicXMLWriter // NOSONAR
{

    const KEY_PROPERTY_TYPE = "propertyType";
    const KEY_DEFAULT_VALUE = "default_value";
    const KEY_NAME = "name";
    const KEY_VALUE = "value";   

    /**
     * Class params
     *
     * @var array
     */
    private $classParams = array();

    /**
     * Null properties
     *
     * @var array
     */
    private $nullProperties = array();
    
    private $_objectName = '';
    
    private $_className = '';

    /**
     * Get null properties
     *
     * @return array
     */
    public function nullPropertiyList()
    {
        return $this->nullProperties;
    }
    
    public function objectName()
    {
        return $this->_objectName;
    }

    /**
     * Constructor
     *
     * @param self|array|object|mixed $data
     * @param mixed $option
     */
    public function __construct($data = null, $option = null)
    {
        $this->_className = get_class($this);
        $jsonAnnot = new PicoAnnotationParser($this->_className);
        $params = $jsonAnnot->getParameters();
        foreach($params as $paramName=>$paramValue)
        {
            $vals = $jsonAnnot->parseKeyValue($paramValue);
            $this->classParams[$paramName] = $vals;
            if($paramName == 'Element' && isset($vals['name']))
            {
                $this->_objectName = $vals['name'];
            }
        }
        if($data !== null)
        {
            if($data instanceof DOMNode)
            {
                $this->loadXml($data);
            }
            else if(($data instanceof DateTime || is_string($data) || is_numeric($data) || is_float($data) || is_integer($data)) 
            && property_exists($this->_className, 'textContent'))
            {
                $this->setTextContent($data);
            }
            else if(is_array($data) || is_object($data))
            {
                $this->loadData($data);
            }
        }
    }
    
    private function mapAttribute()
    {
        return ModelParser::parseModel($this->_className, $this);
    }
    
    private function loadXml($data)
    {
        $maps = $this->mapAttribute();
        foreach($data->attributes as $attributes )
        {
            echo "".$attributes ->nodeName." = ".$attributes ->nodeValue."\r\n";
        }
        foreach($data->childNodes as $child)
        {
            if($child->nodeType == NodeType::ELEMENT)
            {
                // process element
            }
            else if($child->nodeType == NodeType::ATTRIBUTE)
            {
                // process element
                echo "ATTRIBUTE\r\n";
            }
            
            
        }
    }
    
    /**
     * Load data to object
     * @param mixed $data
     * @return self
     */
    public function loadData($data)
    {
        if($data != null)
        {
            if($data instanceof self)
            {
                $values = $data->value();
                foreach ($values as $key => $value) {
                    $key2 = $this->camelize($key);
                    $this->set($key2, $value, true);
                }
            }
            else if (is_array($data) || is_object($data)) {
                foreach ($data as $key => $value) {
                    $key2 = $this->camelize($key);
                    $this->set($key2, $value, true);
                }
            }
        }
        return $this;
    }

    /**
     * Remove property
     *
     * @param object $sourceData
     * @param array $propertyNames
     * @return mixed
     */
    public function removePropertyExcept($sourceData, $propertyNames)
    {
        if(is_object($sourceData))
        {
            // iterate
            $resultData = new stdClass;
            foreach($sourceData as $key=>$val)
            {
                if(in_array($key, $propertyNames))
                {
                    $resultData->$key = $val;
                }
            }
            return $resultData;
        }
        if(is_array($sourceData))
        {
            // iterate
            $resultData = array();
            foreach($sourceData as $key=>$val)
            {
                if(in_array($key, $propertyNames))
                {
                    $resultData[$key] = $val;
                }
            }
            return $resultData;
        }
        return new stdClass;
    }

    /**
     * Convert snake case to camel case
     *
     * @param string $input
     * @param string $separator
     * @return string
     */
    protected function camelize($input, $separator = '_')
    {
        return lcfirst(str_replace($separator, '', ucwords($input, $separator)));
    }

    /**
     * Convert camel case to snake case
     *
     * @param string $input
     * @param string $glue
     * @return string
     */
    protected function snakeize($input, $glue = '_') {
        return ltrim(
            preg_replace_callback('/[A-Z]/', function ($matches) use ($glue) {
                return $glue . strtolower($matches[0]);
            }, $input),
            $glue
        );
    } 

    /**
     * Modify null properties
     *
     * @param string $propertyName
     * @param mixed $propertyValue
     * @return void
     */
    private function modifyNullProperties($propertyName, $propertyValue)
    {
        if($propertyValue === null && !isset($this->nullProperties[$propertyName]))
        {
            $this->nullProperties[$propertyName] = true; 
        }
        if($propertyValue != null && isset($this->nullProperties[$propertyName]))
        {
            unset($this->nullProperties[$propertyName]); 
        }
    }

    /**
     * Set property value
     *
     * @param string $propertyName
     * @param mixed|null
     * @param bool $skipModifyNullProperties
     * @return self
     */
    public function set($propertyName, $propertyValue, $skipModifyNullProperties = false)
    {
        $var = lcfirst($propertyName);
        $var = $this->camelize($var);
        $this->{$var} = $propertyValue;
        if(!$skipModifyNullProperties && $propertyValue === null)
        {
            $this->modifyNullProperties($var, $propertyValue);
        }
        return $this;
    }
    
    /**
     * Get property value
     *
     * @param string $propertyName
     * @return mixed|null
     */
    public function get($propertyName)
    {
        $var = lcfirst($propertyName);
        $var = $this->camelize($var);
        return isset($this->$var) ? $this->$var : null;
    }
    
    /**
     * Get property value 
     *
     * @param string $propertyName
     * @return mixed|null
     */
    public function getOrDefault($propertyName, $defaultValue = null)
    {
        $var = lcfirst($propertyName);
        $var = $this->camelize($var);
        return isset($this->$var) ? $this->$var : $defaultValue;
    }
    
    /**
     * Copy value from other object
     *
     * @param self|mixed $source
     * @param array $filter
     * @param bool $includeNull
     * @return void
     */
    public function copyValueFrom($source, $filter = null, $includeNull = false)
    {
        if($filter != null)
        {
            $tmp = array();
            $index = 0;
            foreach($filter as $val)
            {
                $tmp[$index] = trim($this->camelize($val));   
                $index++;
            }
            $filter = $tmp;
        }
        $values = $source->value();
        foreach($values as $property=>$value)
        {
            if(
                ($filter == null || (is_array($filter) && !empty($filter) && in_array($property, $filter))) 
                && 
                ($includeNull || $value != null)
                )
            {
                $this->set($property, $value);
            }
        }
    }

    /**
     * Unset property value
     *
     * @param string $propertyName
     * @param bool $skipModifyNullProperties
     * @return self
     */
    private function removeValue($propertyName, $skipModifyNullProperties = false)
    {
        return $this->set($propertyName, null, $skipModifyNullProperties);
    }
    
    /**
     * Fix value
     *
     * @param string $value
     * @param string $type
     * @return mixed
     */
    protected function fixValue($value, $type) // NOSONAR
    {
        if(strtolower($value) === 'true')
        {
            return true;
        }
        else if(strtolower($value) === 'false')
        {
            return false;
        }
        else if(strtolower($value) === 'null')
        {
            return false;
        }
        else if(is_numeric($value) && strtolower($type) != 'string')
        {
            return $value + 0;
        }
        else 
        {
            return $value;
        }
    }

    /**
     * Get object value
     * @return stdClass
     */
    public function value($snakeCase = false)
    {
        $parentProps = $this->propertyList(true, true);
        $value = new stdClass;
        foreach ($this as $key => $val) {
            if(!in_array($key, $parentProps))
            {
                $value->$key = $val;
            }
        }
        if($snakeCase)
        {
            $value2 = new stdClass;
            foreach ($value as $key => $val) {
                $key2 = $this->snakeize($key);
                $value2->$key2 = $val;
            }
            return $value2;
        }
        return $value;
    }
    
    /**
     * Get object value
     * @return stdClass
     */
    public function valueObject($snakeCase = false)
    {
        return $this->value($snakeCase);
    }

    /**
     * Get object value as associative array
     * @return array
     */
    public function valueArray($snakeCase = false)
    {
        $value = $this->value($snakeCase);
        return json_decode(json_encode($value), true);
    }
    
    /**
     * Get object value as associated array with upper case first
     *
     * @return array
     */
    public function valueArrayUpperCamel()
    {
        $obj = clone $this;
        $array = (array) $obj->value();
        $renameMap = array();
        $keys = array_keys($array);
        foreach($keys as $key)
        {
            $renameMap[$key] = ucfirst($key);
        }          
        $array = array_combine(array_map(function($el) use ($renameMap) {
            return $renameMap[$el];
        }, array_keys($array)), array_values($array));
        return $array;
    }
    
    /**
     * Check if JSON naming strategy is snake case or not
     *
     * @return bool
     */
    protected function _snake()
    {
        return isset($this->classParams['JSON'])
            && isset($this->classParams['JSON']['property-naming-strategy'])
            && strcasecmp($this->classParams['JSON']['property-naming-strategy'], 'SNAKE_CASE') == 0
            ;
    }
    
    /**
     *  Check if JSON naming strategy is upper camel case or not
     *
     * @return bool
     */
    protected function isUpperCamel()
    {
        return isset($this->classParams['JSON'])
            && isset($this->classParams['JSON']['property-naming-strategy'])
            && strcasecmp($this->classParams['JSON']['property-naming-strategy'], 'UPPER_CAMEL_CASE') == 0
            ;
    }
    
    /**
     * Check if JSON naming strategy is camel case or not
     *
     * @return bool
     */
    protected function _camel()
    {
        return !$this->_snake();
    }

    /**
     * Check if JSON naming strategy is snake case or not
     *
     * @return bool
     */
    protected function _pretty()
    {
        return isset($this->classParams['JSON'])
            && isset($this->classParams['JSON']['prettify'])
            && strcasecmp($this->classParams['JSON']['prettify'], 'true') == 0
            ;
    }
    
    /**
     * Property list
     * @var bool $reflectSelf
     * @var bool $asArrayProps
     * @return array
     */
    protected function propertyList($reflectSelf = false, $asArrayProps = false)
    {
        $reflectionClass = $reflectSelf ? self::class : get_called_class();
        $class = new ReflectionClass($reflectionClass);

        // filter only the calling class properties
        // skip parent properties
        $properties = array_filter(
            $class->getProperties(),
            function($property) use($class) {
                return $property->getDeclaringClass()->getName() == $class->getName();
            }
        );
        if($asArrayProps)
        {
            $result = array();
            $index = 0;
            foreach ($properties as $key) {
                $prop = $key->name;
                $result[$index] = $prop;
                
                $index++;
            }
            return $result;
        }
        else
        {
            return $properties;
        }
    }
    
    /**
     * Convert bool to text
     *
     * @param string $propertyName
     * @param string[] $params
     * @return string
     */
    private function booleanToTextBy($propertyName, $params)
    {
        $value = $this->get($propertyName);
        if(!isset($value))
        {
            $boolVal = false;
        }
        else
        {
            $boolVal = $value === true || $value == 1 || $value = "1"; 
        }
        return $boolVal?$params[0]:$params[1];
    }
    
    /**
     * Get number of property of the object
     *
     * @return integer
     */
    public function size()
    {
        $parentProps = $this->propertyList(true, true);
        $length = 0;
        foreach ($this as $key => $val) {
            if(!in_array($key, $parentProps))
            {
                $length++;
            }
        }
        return $length;
    }

    /**
     * Magic method called when user call any undefined method. __call method will check the prefix of called method and call appropriated method according to its name and its parameters.
     * is &raquo; get property value as bool. Number will true if it's value is 1. String will be convert to number first. This method not require database connection.
     * get &raquo; get property value. This method not require database connection.
     * set &raquo; set property value. This method not require database connection.
     * unset &raquo; unset property value. This method not require database connection.
     * findOneBy &raquo; search data from database and return one record. This method require database connection.
     * findFirstBy &raquo; search data from database and return first record. This method require database connection.
     * findLastBy &raquo; search data from database and return last record. This method require database connection.
     * findBy &raquo; search data from database. This method require database connection.
     * findAscBy &raquo; search data from database order by primary keys ascending. This method require database connection.
     * findDescBy &raquo; search data from database order by primary keys descending. This method require database connection.
     * findAllAsc &raquo; search data from database without filter order by primary keys ascending. This method require database connection.
     * findAllDesc &raquo; search data from database without filter order by primary keys descending. This method require database connection.
     * listBy &raquo; search data from database. Similar to findBy but does not contain a connection to the database so objects cannot be saved directly to the database. This method require database connection.
     * listAscBy &raquo; search data from database order by primary keys ascending. Similar to findAscBy but does not contain a connection to the database so objects cannot be saved directly to the database. This method require database connection.
     * listDescBy &raquo; search data from database order by primary keys descending. Similar to findDescBy but does not contain a connection to the database so objects cannot be saved directly to the database. This method require database connection.
     * listAllAsc &raquo; search data from database without filter order by primary keys ascending. Similar to findAllAsc but does not contain a connection to the database so objects cannot be saved directly to the database. This method require database connection.
     * listAllDesc &raquo; search data from database without filter order by primary keys descending. Similar to findAllDesc but does not contain a connection to the database so objects cannot be saved directly to the database. This method require database connection.
     * countBy &raquo; count data from database.
     * existsBy &raquo; check data from database. This method require database connection.
     * deleteBy &raquo; delete data from database without read it first. This method require database connection.
     * booleanToTextBy &raquo; convert bool value to yes/no or true/false depend on parameters given. Example: $result = booleanToTextByActive("Yes", "No"); If $obj->active is true, $result will be "Yes" otherwise "No". This method not require database connection.
     * booleanToSelectedBy &raquo; Create attribute selected="selected" for form. This method not require database connection.
     * booleanToCheckedBy &raquo; Create attribute checked="checked" for form. This method not require database connection.
     *
     * @param string $method Method name
     * @param mixed $params Parameters
     * @return mixed|null
     */    
    public function __call($method, $params) // NOSONAR
    {
        if (strncasecmp($method, "hasValue", 8) === 0) {
            $var = lcfirst(substr($method, 8));
            return isset($this->$var);
        } 
        else if (strncasecmp($method, "is", 2) === 0) {
            $var = lcfirst(substr($method, 2));
            return isset($this->$var) ? $this->$var == 1 : false;
        } 
        else if (strncasecmp($method, "equals", 6) === 0) {
            $var = lcfirst(substr($method, 6));
            return isset($this->$var) && $this->$var == $params[0];
        } 
        else if (strncasecmp($method, "get", 3) === 0) {
            $var = lcfirst(substr($method, 3));
            return isset($this->$var) ? $this->$var : null;
        }
        else if (strncasecmp($method, "set", 3) === 0) {
            $var = lcfirst(substr($method, 3));
            $this->$var = $params[0];
            $this->modifyNullProperties($var, $params[0]);
            return $this;
        }
        else if (strncasecmp($method, "unset", 5) === 0) {
            $var = lcfirst(substr($method, 5));
            $this->removeValue($var, $params[0]);
            return $this;
        }
        else if (strncasecmp($method, "booleanToTextBy", 15) === 0) {
            $prop = lcfirst(substr($method, 15));
            return $this->booleanToTextBy($prop, $params);
        }
        else if (strncasecmp($method, "booleanToSelectedBy", 19) === 0) {
            $prop = lcfirst(substr($method, 19));
            return $this->booleanToTextBy($prop, array(' selected="selected"', ''));
        }
        else if (strncasecmp($method, "booleanToCheckedBy", 18) === 0) {
            $prop = lcfirst(substr($method, 18));
            return $this->booleanToTextBy($prop, array(' cheked="checked"', ''));
        }     
    }

    /**
     * Magic method to stringify object
     *
     * @return string
     */
    public function __toString()
    {
        $snake = $this->_snake();
        $pretty = $this->_pretty();
        $flag = $pretty ? JSON_PRETTY_PRINT : 0;
        $obj = clone $this;
        foreach($obj as $key=>$value)
        {
            if($value instanceof self)
            {
                $value = $this->stringifyObject($value, $snake);
                $obj->set($key, $value);
            }
        }
        $upperCamel = $this->isUpperCamel();
        if($upperCamel)
        {         
            $value = $this->valueArrayUpperCamel();
            return json_encode($value, $flag);
        }
        else 
        {
            return json_encode($obj->value($snake), $flag);
        }
    }
    
    /**
     * Stringify object
     *
     * @param self $value
     * @param bool $snake
     * @return mixed
     */
    private function stringifyObject($value, $snake)
    {
        if(is_array($value))
        {
            foreach($value as $key2=>$val2)
            {
                if($val2 instanceof self)
                {
                    $value[$key2] = $val2->stringifyObject($val2, $snake);
                }
            }
        }
        else if(is_object($value))
        {
            foreach($value as $key2=>$val2)
            {
                if($val2 instanceof self)
                {
                    
                    $value->{$key2} = $val2->stringifyObject($val2, $snake);
                }
            }
        }
        return $value->value($snake);
    }
    
    
    
    /**
     * Get XML
     *
     * @return DOMNode
     */
    public function toXml($domdoc, $name = null)
    {
        $xmlBuilder = new MusicXMLBuilder($this);
        return $xmlBuilder->toXml($domdoc, $name);
        
    }

    /**
     * Get the value of _objectName
     */ 
    public function getObjectName()
    {
        return $this->_objectName;
    }
}