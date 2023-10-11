<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Defaults
 * @Xml
 * @MusicXML
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/defaults/
 * @Data
 */
class Defaults extends MusicXMLWriter
{
    /**
     * Scaling
     *
     * @Element(name="scaling")      
     * @var Scaling
     */
    public $scaling;

    /**
     * Concert score
     *
     * @Element(name="concert-score")
     * @var ConcertScore
     */
    public $concertScore;

    /**
     * Page layout
     *
     * @Element(name="page-layout")  
     * @var PageLayout
     */
    public $pageLayout;

    /**
     * System layout
     *
     * @Element(name="system-layout")
     * @var SystemLayout
     */
    public $systemLayout;

    /**
     * Staff layout
     *
     * @Element(name="staff-layout")
     * @var StaffLayout[]
     */
    public $staffLayout;

    /**
     * Appearance
     *
     * @Element(name="appearance")
     * @var Appearance
     */
    public $appearance;

    /**
     * Music font
     *
     * @Element(name="music-font")
     * @var MusicFont
     */
    public $musicFont;

    /**
     * Word font
     *
     * @Element(name="word-font")
     * @var WordFont
     */
    public $wordFont;

    /**
     * Lyric font
     *
     * @Element(name="lyric-font")
     * @var LyricFont[]
     */
    public $lyricFont;

    /**
     * Lyric language
     *
     * @Element(name="lyric-language")
     * @var LyricLanguage[]
     */
    public $lyricLanguage;
    
}