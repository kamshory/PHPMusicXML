<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Level
 * @Xml
 * @Referece https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/level/
 * @Data
 */
class Level extends MusicXMLWriter
{
    /**
     * Bracket
     * 
     * @Attribute 
     * @var string
     */
    public $bracket;
    
    /**
     * Parentheses
     * 
     * @Attribute 
     * @var string
     */
    public $parentheses;
    
    /**
     * Reference
     * 
     * @Attribute 
     * @var string
     */
    public $reference;
    
    /**
     * Size
     * 
     * @Attribute 
     * @var string
     */
    public $size;
    
    /**
     * Type
     * 
     * @Attribute 
     * @var string
     */
    public $type;
    
    /**
	 * Text content
	 *
	 * @TextContent
	 * @var string
	 */
	public $textContent;
}