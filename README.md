# PHPMusicXML

PHPMUsicXML is a library for creating MusicXML files and converting music from MIDI format to MusicXML format. This library contains logic and models. Each element in MusicXML is represented by one class as its model.

## Expected Result

Expected result of this library are:

1. to comply MusicXML specification according to https://www.w3.org/2021/06/musicxml40/ 
2. convert music from MIDI format to MusicXML format either compressed or uncompressed


## Example

### Convert MIDI to uncompressed MusicXML

Uncompressed MusicXML is XML file according to https://www.w3.org/2021/06/musicxml40/

```php
<?php

use MusicXML\MusicXML;

require_once "inc.lib/autoload.php";

$musicXML = new MusicXML();
try
{
    $midi = $musicXML->loadMidi("test.mid");
    $xml = $musicXML->midiToMusicXml($midi, "Test", "4.0", "xml");
    file_put_contents("test.xml", $xml);
}
catch(Exception $e)
{
    echo $e->getMessage();  
}
```

### Convert MIDI to compressed MusicXML

Compressed MusicXML is zipped files containing XML file according to https://www.w3.org/2021/06/musicxml40/, mimetype, and META-INF/container.xml

```php
<?php

use MusicXML\MusicXML;
use MusicXML\Util\MXL;

require_once "inc.lib/autoload.php";

$musicXML = new MusicXML();
try
{
    $midi = $musicXML->loadMidi("test.mid");
    $mxl = new MXL();
    $xml = $musicXML->midiToMusicXml($midi, "Test", "4.0", "xml");
    file_put_contents("convert.mxl", $mxl->createMxl("Test", $xml));
}
catch(Exception $e)
{
    echo $e->getMessage();  
}
```

Another way


```php
<?php

use MusicXML\MusicXML;
use MusicXML\Util\MXL;

require_once "inc.lib/autoload.php";

$musicXML = new MusicXML();
try
{
    $midi = $musicXML->loadMidi("test.mid");
    $mxl = $musicXML->midiToMusicXml($midi, "Test", "4.0", MXL::FORMAT_MXL);
    file_put_contents("convert.mxl", $mxl);
}
catch(Exception $e)
{
    echo $e->getMessage();  
}
```

## Progress

1. October 5th 2023 - result is playable but duration longer than expected


## Support Is Required

Support us to develop this library and subscribe our YouTube channel at https://www.youtube.com/@MusicPlanetbiru

## Special Thanks

Thank you https://github.com/talobin/ for your library. We were inspirated to create PHP version from Kotlin version at https://github.com/talobin/MusicXML-Android/

We build the MusicXML model using annotation of each class.

Thank you https://github.com/robbie-cao/ for your library at https://github.com/robbie-cao/midi-class-php/. We learn much about MIDI file format and using code from your library and attach it to our code. We need MIDI parser before create MusicXML file from a MIDI file.
