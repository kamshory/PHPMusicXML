<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * MeasureLayout
 * -
 * MeasureLayout is class of element &lt;measure-layout&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;print&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="measure-layout")
 * @ParentElement(name="print")
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