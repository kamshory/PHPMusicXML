<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * PageMargins
 * @Xml
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/page-margins/
 * @Data
 */
class PageMargins extends MusicXMLWriter
{
	/**
	 * Type
	 *
	 * @Attribute(name="type")
	 * @var string
	 */
	public $type;
    
    /*
     * Left margin
     *
     * @Element(name="left-margin") 
     * @var LeftMargin
     */
    public $leftMargin;

    /*
     * Right margin
     *
     * @Element(name="right-margin")
     * @var RightMargin
     */
    public $rightMargin;

    /*
     * Top margin
     *
     * @Element(name="top-margin")
     * @var TopMargin
     */
    public $topMargin;

    /*
     * Bottom margin
     *
     * @Element(name="bottom-margin")
     * @var BottomMargin
     */
    public $bottomMargin;

}