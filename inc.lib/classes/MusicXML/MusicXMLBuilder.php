<?php

namespace MusicXML;

use DateTime;
use DOMDocument;
use DOMText;
use MusicXML\MusicXMLWriter;
use MusicXML\Util\PicoAnnotationParser;

class MusicXMLBuilder
{
    const ANNOTATION_VAR = "var"; 
    const ANNOTATION_ELEMENT = "Element";
    const ANNOTATION_PROPERTY_ELEMENT = "PropertyElement"; 
    const ANNOTATION_ATTRIBUTE = "Attribute";
    const ANNOTATION_TEXT_CONTENT = "TextContent";
    const ANNOTATION_XML = "Xml";
    const KEY_NAME = "name";
    const KEY_VALUE = "value";
    const KEY_IDENTIFICATION = "identification";
    const ELEMENT = "element";
    const DATE_FORMAT = "Y-m-d";
    
    /**
     * Class name
     *
     * @var string
     */
    private $className = "";

    /**
     * Class name
     *
     * @var string
     */
    private $objectName = "";

    /**
     * Object
     *
     * @var MusicXMLWriter
     */
    private $object = null;
    
    public function __construct($object)
    {
        $this->className = get_class($object);
        $this->object = $object;
        $reflexClass = new PicoAnnotationParser($this->className);
        $parameters = $reflexClass->getParameters();
        foreach($parameters as $parameterName=>$parameterValue)
        {
            if(strcasecmp($parameterName, self::ANNOTATION_XML) == 0)
            {
                $values = $reflexClass->parseKeyValue($parameterValue);
                if(isset($values[self::KEY_NAME]))
                {
                    $this->objectName = $values[self::KEY_NAME];
                }
                else
                {
                    $this->objectName = null;
                }
            }
        }
    }
    
    /**
     * Get value name
     *
     * @param array $values
     * @param string $propertyName
     * @return string
     */
    private function getValueName($values, $propertyName)
    {
        return !empty($values) && isset($values[self::KEY_NAME]) ? trim($values[self::KEY_NAME]) : $propertyName;
    }
    
    /**
     * Get value identification
     *
     * @param array $values
     * @return string
     */
    private function getValueIdentification($values)
    {
        return !empty($values) && isset($values[self::KEY_IDENTIFICATION]) ? trim($values[self::KEY_IDENTIFICATION]) : null;
    }
    
    /**
     * Get tag name
     *
     * @param string $name
     * @return string
     */
    private function getTagName($name)
    {
        $tagName = "";
        if($this->notNullAndNotEmpty($this->objectName))
        {
            $tagName = $this->objectName;
        }
        else if($this->notNullAndNotEmpty($name))
        {
            $tagName = $name;
        }
        return $tagName;
    }
    
    /**
     * Get data type
     *
     * @param string $paramValue
     * @return string
     */
    private function getType($paramValue)
    {
        $paramValue = trim($paramValue);
        // search ] if any
        if(strpos($paramValue, ']') !== false)
        {
            $arr = explode('[', $paramValue, 2);
            while(strpos($arr[0], ' ['))
            {
                $arr[0] = str_replace(' [', '[', $arr[0]);
            }
            return $arr[0];
        }
        return $paramValue;
    }
    
    /**
     * MusicXMLPropertyInfo
     *
     * @param string $propertyName
     * @return MusicXMLPropertyInfo
     */
    private function getPropertyInfo($propertyName)
    {
        $reflexProp = new PicoAnnotationParser($this->className, $propertyName, 'property');
        $parameters = $reflexProp->getParameters();
        $musicXMLPropertyInfo = new MusicXMLPropertyInfo();
        $musicXMLPropertyInfo->setName($propertyName);
        
        foreach($parameters as $param=>$paramValue)
        {
            if(strcasecmp($param, self::ANNOTATION_VAR) == 0)
            {            
                $musicXMLPropertyInfo->setType($this->getType($paramValue));
            }
            else if(strcasecmp($param, self::ANNOTATION_ATTRIBUTE) == 0)
            {
                $musicXMLPropertyInfo->setAttribute(true);
                $values = $reflexProp->parseKeyValue($paramValue);
                $attributeName = $this->getValueName($values, $propertyName);
                $musicXMLPropertyInfo->setAttributeName($attributeName);
            }
            else if(strcasecmp($param, self::ANNOTATION_ELEMENT) == 0)
            {
                $musicXMLPropertyInfo->setElement(true);
                $values = $reflexProp->parseKeyValue($paramValue);
                $elementName = $this->getValueName($values, $propertyName);
                $musicXMLPropertyInfo->setElementName($elementName);
                $identification = $this->getValueIdentification($values);
                $musicXMLPropertyInfo->setIdentification($identification);
            }
            else if(strcasecmp($param, self::ANNOTATION_PROPERTY_ELEMENT) == 0)
            {
                $musicXMLPropertyInfo->setPropertyElement(true);
                $values = $reflexProp->parseKeyValue($paramValue);
                $propertyElementName = $this->getValueName($values, $propertyName);
                $musicXMLPropertyInfo->setPropertyElementName($propertyElementName);
            }
            else if(strcasecmp($param, self::ANNOTATION_TEXT_CONTENT) == 0)
            {
                $musicXMLPropertyInfo->setTextContent(true);
            }
        }
        return $musicXMLPropertyInfo;
    }
    
    
    
    /**
     * Create DOMDocument recorsively
     *
     * @param string $name
     * @return DOMDocument
     */
    public function toXml($domdoc, $name = null) // NOSONAR
    {
        $tagName = $this->getTagName($name);
        $domnode = $domdoc->createElement($tagName);
        foreach($this->object as $propertyName=>$propertyValue)
        {
            $propertInfo = $this->getPropertyInfo($propertyName);
            if($this->notNullAndNotEmpty($propertyValue) || $propertInfo->getTextContent())
            {
                if(is_array($propertyValue))
                {
                    // process array
                    foreach($propertyValue as $value)
                    {
                        if($value instanceof MusicXMLWriter)
                        {
                            if($propertInfo->getElement())
                            {
                                if($propertInfo->getIdentification() != null)
                                {
                                    $tag = $value->objectName();
                                }
                                else if($this->notNullAndNotEmpty($propertInfo->getElementName()))
                                {
                                    $tag = $propertInfo->getElementName();
                                }
                                else 
                                {
                                    $tag = $propertInfo->getName();
                                }
                                $child = $value->toXml($domdoc, $tag);
                                $domnode->appendChild($child);
                            }
                            else if($propertInfo->getPropertyElement())
                            {
                                if($propertInfo->getIdentification() != null)
                                {
                                    $tag = $value->objectName();
                                }
                                else if($this->notNullAndNotEmpty($propertInfo->getPropertyElementName()))
                                {
                                    $tag = $propertInfo->getPropertyElementName();
                                }
                                else
                                {
                                    $tag = $propertInfo->getName();
                                }
                                $child = $value->toXml($domdoc, $tag);
                                $domnode->appendChild($child);
                            }
                        }
                    }
                }
                else
                {
                    // process object
                    if($propertyValue instanceof MusicXMLWriter)
                    {                     
                        if($propertInfo->getElement())
                        {
                            $child = $propertyValue->toXml($domdoc, $propertInfo->getElementName());
                            $domnode->appendChild($child);
                        }
                    }
                    else
                    {
                        
                        // Traditional and PHP data type
                        if($propertInfo->getPropertyElement())
                        {                          
                            if(is_array($propertyValue))
                            {
                                
                                foreach($propertyValue as $value)
                                {
                                    if($value instanceof MusicXMLWriter)
                                    {
                                        $child = $value->toXml($domdoc, $propertInfo->getPropertyElementName());
                                        $domnode->appendChild($child);
                                    }
                                }
                            }
                            else
                            {                               
                                $value = "";
                                if($propertyValue instanceof DateTime)
                                {
                                    $value = $propertyValue->format(self::DATE_FORMAT);
                                }
                                else
                                {
                                    $value = $propertyValue;
                                }
                                $domnode->appendChild($domdoc->createElement($propertInfo->getPropertyElementName(), $value));
                            }
                        }
                        else if($propertInfo->getAttribute())
                        {
                            
                            if($this->notNullAndNotEmpty($propertyValue))
                            {
                                $domnode->setAttribute($propertInfo->getAttributeName(), $propertyValue);
                            }
                        }
                        else if($propertInfo->getTextContent())
                        {
                            $newText = new DOMText($this->getStringValue($propertyValue));
                            $domnode->appendChild($newText);
                        }
                    }
                }
            }
        }
        return $domnode;
    }
    
    /**
     * Convert object to string
     *
     * @param [type] $propertyValue
     * @return string
     */
    private function getStringValue($propertyValue)
    {
        if($propertyValue instanceof DateTime)
        {
            $value = $propertyValue->format(self::DATE_FORMAT);
        }
        else
        {
            $value = $propertyValue;
        }
        return $value;
    }
    
    /**
     * Check if data is not null and not empty
     *
     * @param mixed $value
     * @return bool
     */
    private function notNullAndNotEmpty($value)
    {
        return $value !== null && (!is_string($value) || (is_string($value) && !empty($value)));
    }

    /**
     * Get class name
     *
     * @return  string
     */ 
    public function getObjectName()
    {
        return $this->objectName;
    }
}