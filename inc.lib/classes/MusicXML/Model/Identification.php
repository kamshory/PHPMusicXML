<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Identification
 * -
 * Identification is class of element &lt;identification&gt; Open link at &#64;Referece to read full documentation.
 * Parent elements: &lt;score-part&gt;, &lt;score-partwise&gt;, &lt;score-timewise&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="identification")
 * @ParentElement(name="score-part,score-partwise,score-timewise")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/identification/
 * @Data
 */
class Identification extends MusicXMLWriter
{

    /**
     * Copyright
     *
     * @Element(name="rights")
     * @var Rights[]
     */
    public $rights;

    /**
     * Text content
     *
     * @Element
     * @var Encoding
     */
    public $encoding;

    /**
     * Creator
     *
     * @Element(name="creator")
     * @var Creator[]
     */
    public $creator;

    /**
     * Source
     *
     * @Attribute(name="source")
     * @var Source
     */
    public $source;

    /**
     * Relation
     *
     * @Attribute(name="relation")
     * @var Relation[]
     */
    public $relation;

    /**
     * Miscellaneous
     *
     * @Attribute(name="miscellaneous")
     * @var Miscellaneous[]
     */
    public $miscellaneous;
}