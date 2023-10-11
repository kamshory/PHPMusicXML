<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * PageLayout
 * @Xml
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/page-layout/
 * @Data
 */
class PageLayout extends MusicXMLWriter
{
    /**
     * Page height
     *
     * @Element(name="page-height")
     * @var PageHeight
     */
    public $pageHeight;

    /**
     * Page width
     *
     * @Element(name="page-width")
     * @var PageWidth
     */
    public $pageWidth;

    /**
     * Page margins
     *
     * @Element(name="page-margins")
     * @var PageMargins[]
     */
    public $pageMargins;

    
}