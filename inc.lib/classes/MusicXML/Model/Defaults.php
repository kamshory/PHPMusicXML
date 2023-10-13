<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Defaults
 * -
 * Defaults is class of element &lt;defaults&gt; Open link at &#64;Referece to read full documentation.
 * Parent elements: &lt;score-partwise&gt;, &lt;score-timewise&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="defaults")
 * @ParentElement(name="score-partwise,score-timewise")
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