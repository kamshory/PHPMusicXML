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
    
    /**
     * Convert musicxml to mxl
     *
     * @notice This method required access to create temporary file
     * @param string $name File name without extension
     * @param string $xml XML document of MusicXML
     * @param string $mimetype MIME type
     * @return string Compressed file
     * @throws FilePermissionExcetion when failed to create temporary file
     */
    public function xmlToMxl($name, $xml, $mimetype = "application/vnd.recordare.musicxml")
    {
        $mediatype = $mimetype.'+xml';     
        $fname = $name;
        if(stripos($fname, '.musicxml') === false)
        {
            $fname = $fname.'.musicxml';
        }
        $tmp_dir = sys_get_temp_dir();
        $tmp_location = tempnam($tmp_dir, "__tmp");
        register_shutdown_function('unlink', $tmp_location);
        $zip = new ZipArchive();
        if ($zip->open($tmp_location, ZipArchive::CREATE)!==true) {
            throw new FilePermissionExcetion("Filed to create temporary file");
        }
        $zip->addFromString($fname, $xml);
        $zip->addFromString('mimetype', $mimetype);
        $zip->addEmptyDir('META-INF');
        
        /*
        Native code
        $container = '<?xml version="1.0" encoding="UTF-8"?><container>
    <rootfiles>
        <rootfile full-path="'.$fname.'" media-type="'.$mediatype.'"/>
    </rootfiles>
</container>
';
        */
        $container = $this->getContainer($fname, $mediatype, "1.0", "UTF-8");
        $zip->addFromString('META-INF/container.xml', $container->saveXML());     
        $zip->close();       
        return file_get_contents($tmp_location);
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
    public function getContainer($fullPath, $mediaType, $xmlVersion = "1.0", $encoding = "UTF-8")
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
