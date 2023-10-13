<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * PageLayout
 * -
 * PageLayout is class of element &lt;page-layout&gt; Open link at &#64;Referece to read full documentation.
 * Parent elements: &lt;defaults&gt;, &lt;print&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="page-layout")
 * @ParentElement(name="defaults,print")
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