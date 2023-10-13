<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * CreditImage
 * -
 * CreditImage is class of element &lt;credit-image&gt; Open link at &#64;Referece to read full documentation.
 * Parent element: &lt;credit&gt;
 * 
 * @Xml
 * @MusicXML
 * @Element(name="credit-image")
 * @ParentElement(name="credit")
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/credit-image/
 * @Data
 */
class CreditImage extends MusicXMLWriter
{
	/**
	 * Default x
	 * -
	 * Changes the computation of the default horizontal position. The origin is changed relative to the bottom left-hand corner of the specified page. Positive x is right and negative x is left.
	 *
	 * @Attribute(name="default-x")
	 * @Value(type="tenths" required="false", min="-infinite", max="infinite")
	 * @var float
	 */
	public $defaultX;

	/**
	 * Default y
	 * -
	 * Changes the computation of the default vertical position. The origin is changed relative to the bottom left-hand corner of the specified page. Positive y is up and negative y is down.
	 *
	 * @Attribute(name="default-y")
	 * @Value(type="tenths" required="false", min="-infinite", max="infinite")
	 * @var float
	 */
	public $defaultY;

	/**
	 * Halign
	 * -
	 * Indicates horizontal alignment to the left, center, or right of the image. Default is implementation-dependent.
	 *
	 * @Attribute(name="halign")
	 * @Value(type="left-center-right" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $halign;

	/**
	 * Height
	 * -
	 * Used to size and scale an image. The image should be scaled independently in X and Y if both height and width are specified. If only height is specified, the image should be scaled proportionally to fit in the specified Y dimension.
	 *
	 * @Attribute(name="height")
	 * @Value(type="tenths" required="false", min="-infinite", max="infinite")
	 * @var float
	 */
	public $height;

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
	 * Relative x
	 * -
	 * Changes the horizontal position relative to the default position, either as computed by the individual program, or as overridden by the default-x attribute.  Positive x is right and negative x is left.
	 *
	 * @Attribute(name="relative-x")
	 * @Value(type="tenths" required="false", min="-infinite", max="infinite")
	 * @var float
	 */
	public $relativeX;

	/**
	 * Relative y
	 * -
	 * Changes the vertical position relative to the default position, either as computed by the individual program, or as overridden by the default-y attribute. Positive y is up and negative y is down.
	 *
	 * @Attribute(name="relative-y")
	 * @Value(type="tenths" required="false", min="-infinite", max="infinite")
	 * @var float
	 */
	public $relativeY;

	/**
	 * Source
	 * -
	 * The URL for the image file.
	 *
	 * @Attribute(name="source")
	 * @Value(type="anyURI" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $source;

	/**
	 * Type
	 * -
	 * The MIME type for the image file format. Typical choices include application/postscript, image/gif, image/jpeg, image/png, and image/tiff.
	 *
	 * @Attribute(name="type")
	 * @Value(type="token" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $type;

	/**
	 * Valign
	 * -
	 * Indicates vertical alignment to the top, middle, or bottom of the image. The default is implementation-dependent.
	 *
	 * @Attribute(name="valign")
	 * @Value(type="valign-image" required="false", allowed="ANY_VALUE")
	 * @var string
	 */
	public $valign;

	/**
	 * Width
	 * -
	 * Used to size and scale an image. The image should be scaled independently in X and Y if both height and width are specified. If only width is specified, the image should be scaled proportionally to fit in the specified X dimension.
	 *
	 * @Attribute(name="width")
	 * @Value(type="tenths" required="false", min="-infinite", max="infinite")
	 * @var float
	 */
	public $width;

}