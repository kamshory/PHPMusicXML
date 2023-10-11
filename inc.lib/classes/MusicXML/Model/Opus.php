<?php

namespace MusicXML\Model;

use MusicXML\MusicXMLWriter;

/**
 * Opus
 * @Xml
 * @MusicXML
 * @Path /work
 * @Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/elements/opus-reference/
 * @Data
 */
class Opus extends MusicXMLWriter
{
    /**
     * X-Link H-Ref
     *
     * @Attribute(name="xlink:href")
     * @var string
     */
    public $xlinkHref;
    
    
    /**
     * X-Link actuate
     *
     * @Attribute(name="xlink:actuate")
     * @var string
     */
    public $xlinkAcute;
    
    
    /**
     * X-Link role
     *
     * @Attribute(name="xlink:role")
     * @var string
     */
    public $xlinkRole;
    
    
    /**
     * X-Link show
     *
     * @Attribute(name="xlink:show")
     * @var string
     */
    public $xlinkShow;
    
    
    /**
     * X-Link title
     *
     * @Attribute(name="xlink:title")
     * @var string
     */
    public $xlinkTitle;
    
    /**
     * X-Link type
     *
     * @Attribute(name="xlink:type")
     * @var string
     */
    public $xlinkType;
}