<?php

namespace MusicXML;

use DateTime;
use DOMDocument;
use DOMText;
use MusicXML\MusicXMLWriter;
use MusicXML\Util\PicoAnnotationParser;
use MusicXML\XMLPropertyInfo;
use SimpleXMLElement;

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
     * Get tag name
     *
     * @param string $name
     * @return string
     */
    private function getTagName($name)
    {
        $tagName = "";
        if($this->_notNullAndNotEmpty($this->objectName))
        {
            $tagName = $this->objectName;
        }
        else if($this->_notNullAndNotEmpty($name))
        {
            $tagName = $name;
        }
        return $tagName;
    }
    
    /**
     * XMLPropertyInfo
     *
     * @param string $propertyName
     * @return XMLPropertyInfo
     */
    private function getPropertyInfo($propertyName)
    {
        $reflexProp = new PicoAnnotationParser($this->className, $propertyName, 'property');
        $parameters = $reflexProp->getParameters();
        
        
        $xmlPropertyInfo = new XMLPropertyInfo();
        
        $xmlPropertyInfo->setName($propertyName);
        
        foreach($parameters as $param=>$paramValue)
        {
            if(strcasecmp($param, self::ANNOTATION_VAR) == 0)
            {
                $xmlPropertyInfo->setType(trim($paramValue));
            }
            else if(strcasecmp($param, self::ANNOTATION_ATTRIBUTE) == 0)
            {
                $xmlPropertyInfo->setAttribute(true);
                $values = $reflexProp->parseKeyValue($paramValue);
                $attributeName = $this->getValueName($values, $propertyName);
                $xmlPropertyInfo->setAttributeName($attributeName);
            }
            else if(strcasecmp($param, self::ANNOTATION_ELEMENT) == 0)
            {
                $xmlPropertyInfo->setElement(true);
                $values = $reflexProp->parseKeyValue($paramValue);
                $elementName = $this->getValueName($values, $propertyName);
                $xmlPropertyInfo->setElementName($elementName);
            }
            else if(strcasecmp($param, self::ANNOTATION_PROPERTY_ELEMENT) == 0)
            {
                $xmlPropertyInfo->setPropertyElement(true);
                $values = $reflexProp->parseKeyValue($paramValue);
                $propertyElementName = $this->getValueName($values, $propertyName);
                $xmlPropertyInfo->setPropertyElementName($propertyElementName);
            }
            else if(strcasecmp($param, self::ANNOTATION_TEXT_CONTENT) == 0)
            {
                $xmlPropertyInfo->setTextContent(true);
            }
        }
        return $xmlPropertyInfo;
    }
    
    
    
    /**
     * Create DOMDocument
     *
     * @param string $name
     * @return DOMDocument
     */
    public function toXml($domdoc, $name = null)
    {
        $tagName = $this->getTagName($name);
        $domnode = $domdoc->createElement($tagName);
        foreach($this->object as $propertyName=>$propertyValue)
        {
            $propertInfo = $this->getPropertyInfo($propertyName);
            if(is_array($propertyValue))
            {
                
        
                // process array
                foreach($propertyValue as $value)
                {
                    if($value instanceof MusicXMLWriter)
                    {
                        if($propertInfo->getElement())
                        {
                            if($this->_notNullAndNotEmpty($propertInfo->getElementName()))
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
                            if($this->_notNullAndNotEmpty($propertInfo->getPropertyElementName()))
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
                                $value = $propertyValue->format('Y-m-d');
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
                        
                        if($this->_notNullAndNotEmpty($propertyValue))
                        {
                            $domnode->setAttribute($propertInfo->getAttributeName(), $propertyValue);
                        }
                    }
                    else if($propertInfo->getTextContent())
                    {
                        
                        $newText = new DOMText($propertyValue);
                        $domnode->appendChild($newText);
                    }
                }
            }
        }
        return $domnode;
    }
    
    /**
     * Check if data is not null and not empty
     *
     * @param mixed $value
     * @return bool
     */
    private function _notNullAndNotEmpty($value)
    {
        return $value != null && !empty($value);
    }
}