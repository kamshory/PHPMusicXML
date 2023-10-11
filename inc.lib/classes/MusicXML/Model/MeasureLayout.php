<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * MeasureLayout
 * @Xml
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/measure-layout/
 * @Data
 */
class MeasureLayout extends MusicXMLWriter
{
    /**
     * Measure distance
     *
     * @Element(name="measure-distance")
     * @var MeasureDistance
     */
    public $measureDistance;
}