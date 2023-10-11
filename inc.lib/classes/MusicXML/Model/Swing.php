<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Swing
 * @Xml
 * @MusicXML
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/swing/
 * @Data
 */
class Swing extends MusicXMLWriter
{
    /**
     * Straight
     *
     * @Element(name="straight")
     * @var Straight
     */
    public $straight;

    /**
     * First
     *
     * @Element(name="first")
     * @var First
     */
    public $first;

    /**
     * Second
     *
     * @Element(name="second")
     * @var Second
     */
    public $second;

    /**
     * Swing type
     *
     * @Element(name="swing-type")
     * @var SwingType
     */
    public $swingType;

    /**
     * Swing style
     *
     * @Element(name="swing-style")
     * @var SwingStyle
     */
    public $swingStyle;

}