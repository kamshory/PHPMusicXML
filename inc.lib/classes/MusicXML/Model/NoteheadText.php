<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * NoteheadText
 * @Xml
 * @MusicXML
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/notehead-text/
 * @Data
 */
class NoteheadText extends MusicXMLWriter
{    
	/*
     * Display text
     *
     * @Element(name="display-text")
     * @var DisplayText
     */
    public $displayText;

    /**
     * Accidental text
     *
     * @Element(name="accidental-text")
     * @var AccidentalText
     */
    public $accidentalText;

}