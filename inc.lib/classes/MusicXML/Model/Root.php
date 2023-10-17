<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Root
 * -
 * Root is class of element &lt;root&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;harmony&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="root")
 * @ParentElement(name="harmony")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/root/
 * @Data
 */
class Root extends MusicXMLWriter
{

    /**
     * Root step
     *
     * @Element(name="root-step")
     * @var RootStep
     */
    public $rootStep;

    /**
     * Root alter
     *
     * @Element(name="root-alter")
     * @var RootAlter
     */
    public $rootAlter;

}