<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Credit
 * -
 * Credit is class of element &lt;credit&gt; Open link at &#64;Referece to read full documentation.
 * Parent elements: &lt;score-partwise&gt;, &lt;score-timewise&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="credit")
 * @ParentElement(name="score-partwise,score-timewise")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/credit/
 * @Data
 */
class Credit extends MusicXMLWriter
{
	/**
	 * Id
	 * -
	 * Specifies an ID that is unique to the entire document.
	 *
	 * @Attribute(name="id")
	 * @Value(type="ID" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $id;

	/**
	 * Page
	 * -
	 * Specifies the page number where the &lt;credit&gt; should appear. This is an integer value that starts with 1 for the first page. Its value is 1 if not specified. Since credits occur before the music, these page numbers do not refer to the page numbering specified by the &lt;print&gt; element's page-number attribute.
	 *
	 * @Attribute(name="page")
	 * @Value(type="positiveInteger" required="false", min="0", max="infinite")
	 * @var integer
	 */
	public $page;

    /**
     * Credit type
     *
     * @Element(name="credit-type")
     * @var CreditType[]
     */
    public $creditType;

    /**
     * Credit image
     *
     * @Element(name="credit-image")
     * @var CreditImage
     */
    public $creditImage;

    /**
     * Link
     *
     * @Element(name="link")
     * @var Link[]
     */
    public $link;

    /**
     * Bookmark
     *
     * @Element(name="bookmark")
     * @var Bookmark[]
     */
    public $bookmark;

    /**
     * Credit words
     *
     * @Element(name="credit-words")
     * @var CreditWords
     */
    public $creditWords;

    /**
     * Credit symbol
     *
     * @Element(name="credit-symbol")
     * @var CreditSymbol
     */
    public $creditSymbol;

}