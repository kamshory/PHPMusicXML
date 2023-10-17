<?php

namespace MusicXML;

class MusicXMLPropertyInfo //NOSONAR
{
    /**
     * Name
     *
     * @var string
     */
    private $name = "";
    /**
     * Data type
     *
     * @var string
     */
    private $type = "";
    
    /**
     * Property element
     *
     * @var boolean
     */
    private $propertyElement = false;
    
    /**
     * Property element name
     *
     * @var string
     */
    private $propertyElementName = "";
    
    /**
     * Property element value
     *
     * @var mixed
     */
    private $propertyElementValue = null;
    
    /**
     * Element
     *
     * @var boolean
     */
    private $element = false;
    
    /**
     * Property element name
     *
     * @var string
     */
    private $elementName = "";
    
    /**
     * Element value
     *
     * @var mixed
     */
    private $elementValue = null;
    
    /**
     * Attribute
     *
     * @var boolean
     */
    private $attribute = false;
    
    /**
     * Attribute name
     *
     * @var string
     */
    private $attributeName = "";
    
    /**
     * Attribute value
     *
     * @var mixed
     */
    private $attributeValue = null;
    
    /**
     * Text content
     *
     * @var boolean
     */
    private $textContent = false;
    
    /**
     * Text content value
     *
     * @var string
     */
    private $textContentValue = "";
    
    /**
     * Identification
     *
     * @var string
     */
    private $identification = null;
    
    

    /**
     * Get data type
     *
     * @return  string
     */ 
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set data type
     *
     * @param  string  $type  Data type
     *
     * @return  self
     */ 
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get property element
     *
     * @return  boolean
     */ 
    public function getPropertyElement()
    {
        return $this->propertyElement;
    }

    /**
     * Set property element
     *
     * @param  boolean  $propertyElement  Property element
     *
     * @return  self
     */ 
    public function setPropertyElement($propertyElement)
    {
        $this->propertyElement = $propertyElement;

        return $this;
    }

    /**
     * Get property element name
     *
     * @return  string
     */ 
    public function getPropertyElementName()
    {
        return $this->propertyElementName;
    }

    /**
     * Set property element name
     *
     * @param  string  $propertyElementName  Property element name
     *
     * @return  self
     */ 
    public function setPropertyElementName($propertyElementName)
    {
        $this->propertyElementName = $propertyElementName;

        return $this;
    }

    /**
     * Get property element value
     *
     * @return  mixed
     */ 
    public function getPropertyElementValue()
    {
        return $this->propertyElementValue;
    }

    /**
     * Set property element value
     *
     * @param  mixed  $propertyElementValue  Property element value
     *
     * @return  self
     */ 
    public function setPropertyElementValue($propertyElementValue)
    {
        $this->propertyElementValue = $propertyElementValue;

        return $this;
    }

    /**
     * Get element
     *
     * @return  boolean
     */ 
    public function getElement()
    {
        return $this->element;
    }

    /**
     * Set element
     *
     * @param  boolean  $element  Element
     *
     * @return  self
     */ 
    public function setElement($element)
    {
        $this->element = $element;

        return $this;
    }

    /**
     * Get property element name
     *
     * @return  string
     */ 
    public function getElementName()
    {
        return $this->elementName;
    }

    /**
     * Set property element name
     *
     * @param  string  $elementName  Property element name
     *
     * @return  self
     */ 
    public function setElementName($elementName)
    {
        $this->elementName = $elementName;

        return $this;
    }

    /**
     * Get element value
     *
     * @return  mixed
     */ 
    public function getElementValue()
    {
        return $this->elementValue;
    }

    /**
     * Set element value
     *
     * @param  mixed  $elementValue  Element value
     *
     * @return  self
     */ 
    public function setElementValue($elementValue)
    {
        $this->elementValue = $elementValue;

        return $this;
    }

    /**
     * Get attribute
     *
     * @return  boolean
     */ 
    public function getAttribute()
    {
        return $this->attribute;
    }

    /**
     * Set attribute
     *
     * @param  boolean  $attributes  Attribute
     *
     * @return  self
     */ 
    public function setAttribute($attributes )
    {
        $this->attribute = $attributes ;

        return $this;
    }

    /**
     * Get attribute name
     *
     * @return  string
     */ 
    public function getAttributeName()
    {
        return $this->attributeName;
    }

    /**
     * Set attribute name
     *
     * @param  string  $attributeName  Attribute name
     *
     * @return  self
     */ 
    public function setAttributeName($attributeName)
    {
        $this->attributeName = $attributeName;

        return $this;
    }

    /**
     * Get attribute value
     *
     * @return  mixed
     */ 
    public function getAttributeValue()
    {
        return $this->attributeValue;
    }

    /**
     * Set attribute value
     *
     * @param  mixed  $attributeValue  Attribute value
     *
     * @return  self
     */ 
    public function setAttributeValue($attributeValue)
    {
        $this->attributeValue = $attributeValue;

        return $this;
    }

    /**
     * Get text content
     *
     * @return  boolean
     */ 
    public function getTextContent()
    {
        return $this->textContent;
    }

    /**
     * Set text content
     *
     * @param  boolean  $textContent  Text content
     *
     * @return  self
     */ 
    public function setTextContent($textContent)
    {
        $this->textContent = $textContent;

        return $this;
    }

    /**
     * Get text content value
     *
     * @return  string
     */ 
    public function getTextContentValue()
    {
        return $this->textContentValue;
    }

    /**
     * Set text content value
     *
     * @param  string  $textContentValue  Text content value
     *
     * @return  self
     */ 
    public function setTextContentValue($textContentValue)
    {
        $this->textContentValue = $textContentValue;

        return $this;
    }

    /**
     * Get name
     *
     * @return  string
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set name
     *
     * @param  string  $name  Name
     *
     * @return  self
     */ 
    public function setName(string $name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get identification
     *
     * @return  string
     */ 
    public function getIdentification()
    {
        return $this->identification;
    }

    /**
     * Set identification
     *
     * @param  string|null  $identification  Identification
     *
     * @return  self
     */ 
    public function setIdentification($identification)
    {
        $this->identification = $identification;

        return $this;
    }
}