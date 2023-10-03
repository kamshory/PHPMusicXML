<?php

namespace MusicXML\Util;

use ZipArchive;

class MXL
{
    const MXL = "mxl";
    const XML = "xml";
    const MUSICXML = "musicxml";
    
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
            return null;
        }
        $zip->addFromString($fname, $xml);
        $zip->addFromString('mimetype', $mimetype);
        $zip->addEmptyDir('META-INF');       
        $container = '<?xml version="1.0" encoding="UTF-8"?><container>
    <rootfiles>
        <rootfile full-path="'.$fname.'" media-type="'.$mediatype.'"/>
    </rootfiles>
</container>
';
        $zip->addFromString('META-INF/container.xml', $container);     
        $zip->close();       
        return file_get_contents($tmp_location);
    }    
}