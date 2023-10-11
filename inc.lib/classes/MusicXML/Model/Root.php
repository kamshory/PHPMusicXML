<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Root
 * @Xml
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