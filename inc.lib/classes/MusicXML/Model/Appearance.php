<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Appearance
 * -
 * Appearance is class of element &lt;appearance&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;defaults&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="appearance")
 * @ParentElement(name="defaults")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/appearance/
 * @Data
 */
class Appearance extends MusicXMLWriter
{

    /**
     * Line width
     *
     * @Element(name="line-width")
     * @var LineWidth[]
     */
    public $lineWidth;

    /**
     * Note size
     *
     * @Element(name="note-size")
     * @var NoteSize[]
     */
    public $noteSize;

    /**
     * Distance
     *
     * @Element(name="distance")
     * @var Distance[]
     */
    public $distance;

    /**
     * Glyph
     *
     * @Element(name="glyph")
     * @var Glyph[]
     */
    public $glyph;

    /**
     * Other appearance
     *
     * @Element(name="other-appearance")
     * @var OtherAppearance[]
     */
    public $otherAppearance;
}