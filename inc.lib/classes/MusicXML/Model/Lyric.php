<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Lyric
 * @Xml
 * @Path /path/measure/note/lyric
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/lyric/
 * @Data
 */
class Lyric extends MusicXMLWriter
{
    /**
     * Syllabic
     *
     * @Element
     * @var Syllabic
     */
    public $syllabic;
    
    /**
     * Elision
     *
     * @Element
     * @var Elision
     */
    public $elision;
    
    /**
     * Text
     *
     * @Element
     * @var Text
     */
    public $text;
    
    /**
     * Text
     *
     * @PropertyElement
     * @var string
     */
    public $textContent;
    
    /**
     * End line
     *
     * @Element(name="end-line")
     * @var EndLine
     */
    public $endLine;
    
    /**
     * End paragraph
     *
     * @Element(name="end-line")
     * @var EndParagraph
     */
    public $endParagraph;
}