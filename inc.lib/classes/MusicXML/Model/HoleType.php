<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * HoleType
 * -
 * HoleType is class of element &lt;hole-type&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;hole&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="hole-type")
 * @ParentElement(name="hole")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/hole-type/
 * @Data
 */
class HoleType extends MusicXMLWriter
{

    /**
     * Hole type
     *
     * @Element(name="hole-type")
     * @var HoleType
     */
    public $holeType;

    /**
     * Hole closed
     *
     * @Element(name="hole-closed")
     * @var HoleClosed
     */
    public $holeClosed;

    /**
     * Hole shape
     *
     * @Element(name="hole-shape")
     * @var HoleShape
     */
    public $holeShape;

    /**
	 * Text content
	 *
	 * @TextContent
	 * @var string
	 */
	public $textContent;
}