<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Credit
 * @Xml
 * @MusicXML
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/credit/
 * @Data
 */
class Credit extends MusicXMLWriter
{
	/**
	 * Id
	 *
	 * @Attribute(name="id")
	 * @var string
	 */
	public $id;

	/**
	 * Page
	 *
	 * @Attribute(name="page")
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