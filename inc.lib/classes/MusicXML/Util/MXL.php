<?php

namespace MusicXML\Util;

use DOMDocument;
use Exceptions\FilePermissionExcetion;
use ZipArchive;

/**
 * MusicXML compressor
 */
class MXL
{
    const FORMAT_MXL = "mxl";
    const FORMAT_XML = "xml";
    const FORMAT_MUSICXML = "musicxml";
    const MIME_TYPE = "application/vnd.recordare.musicxml";
    const EXT_MUSICXML = '.musicxml';
    const CONTAINER_PATH = 'META-INF/container.xml';
    const CONTAINER_DIR = 'META-INF';
    const XML_VERSION = '1.0';
    const XML_ENCODING = 'UTF-8';
    
    /**
     * Convert musicxml to mxl
     *
     * @notice This method required access to create temporary file
     * @param string $name File name without extension
     * @param string $xml XML document of MusicXML
     * @param string $mimeType MIME type
     * @return string Compressed file
     * @throws FilePermissionExcetion when failed to create temporary file
     */
    public function xmlToMxl($name, $xml, $mimeType = self::MIME_TYPE)
    {
        $mediatype = $this->getMediaType($mimeType);  
        $fname = $name;
        if(stripos($fname, self::EXT_MUSICXML) === false)
        {
            $fname = $fname.self::EXT_MUSICXML;
        }
        $tmp_dir = sys_get_temp_dir();
        $tmp_location = tempnam($tmp_dir, "__tmp");
        register_shutdown_function(array($this, 'unlink'), $tmp_location);
        $zip = new ZipArchive();
        if ($zip->open($tmp_location, ZipArchive::CREATE)!==true) {
            throw new FilePermissionExcetion("Filed to create temporary file");
        }
        $zip->addFromString($fname, $xml);
        $zip->addFromString('mimetype', $mimeType);
        $zip->addEmptyDir(self::CONTAINER_DIR);
        
        $container = $this->getContainer($fname, $mediatype, self::XML_VERSION, self::XML_ENCODING);
        $zip->addFromString(self::CONTAINER_PATH, $container->saveXML());     
        $zip->close();       
        return file_get_contents($tmp_location);
    }  
    
    /**
     * Get media type
     *
     * @param string $mimeType
     * @return string
     */
    private function getMediaType($mimeType)
    {
        return $mimeType.'+xml'; 
    }
    
    /**
     * Delete file
     *
     * @param string $filename
     * @return void
     */
    private function unlink($filename)
    {
        if(file_exists($filename))
        {
            unlink($filename);
        }
    }
    
    /**
     * Get container
     *
     * @param string $fullPath Full path
     * @param string $mediaType Media type
     * @param string $xmlVersion XML version
     * @param string $encoding Charset encoding
     * @return DOMDocument 
     */
    public function getContainer($fullPath, $mediaType, $xmlVersion = self::XML_VERSION, $encoding = self::XML_ENCODING)
    {
        $domdoc = new DOMDocument();
        $domdoc->xmlVersion = $xmlVersion;
        $domdoc->encoding = $encoding;

        $container = $domdoc->createElement("container");
        $rootfiles = $domdoc->createElement("rootfiles");
        $rootfile1 = $domdoc->createElement("rootfile");
        $rootfile1->setAttribute("full-path", $fullPath);
        $rootfile1->setAttribute("media-type", $mediaType);

        $rootfiles->appendChild($rootfile1);
        $container->appendChild($rootfiles);
        $domdoc->appendChild($container);
        
        $domdoc->preserveWhiteSpace = false;
        $domdoc->formatOutput = true;
        return $domdoc;
    }
}
