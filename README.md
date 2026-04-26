# PHPMusicXML

PHPMusicXML is a robust PHP library for creating, manipulating, and converting music notation files. It specializes in converting MIDI files into highly readable MusicXML format, with advanced logic to handle complex musical notation and lyrics. Each element in the MusicXML schema is represented by a dedicated class model within the library.

## Key Features

1. **Advanced Lyric Spacing**: Automatically calculates and intervenes in note positioning (`default-x`) to prevent lyric overlaps, ensuring professional-looking scores.
2. **Channel Filtering**: Convert specific MIDI channels or the entire file.
3. **Percussion Support**: Automatic mapping of MIDI Channel 10 to standard MusicXML percussion notation.
4. **Chord Detection**: Intelligent detection of simultaneous notes.
5. **High Compatibility**: Optimized for popular notation software like MuseScore, Sibelius, and Finale.
6. **Comprehensive Models**: Implements elements based on the MusicXML 4.0 Reference.

## Core Capabilities

1. Read, modify, and write MusicXML files.
2. Convert MIDI to MusicXML (Compressed `.mxl` or Uncompressed `.xml`).
3. Convert MusicXML to MIDI (Experimental).

## Getting Started

### 1. Command Line Usage (CLI)

The easiest way to convert files is using the `convert.php` script:

**Basic Conversion:**
```bash
php convert.php "input.mid"
```

**Select Specific Channels (e.g., Vocal on Channel 4):**
```bash
php convert.php "input.mid" --channels=4
```

**Bulk Conversion:**
```bash
php convert.php --dir="midi_folder"
```

*For more detailed CLI instructions, please refer to manual.md.*

---

### 2. Library Usage (PHP)

You can integrate PHPMusicXML directly into your project.

#### Convert MIDI to Uncompressed MusicXML

Uncompressed MusicXML is a standard XML file compatible with most notation software.

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

require_once "inc.lib/autoload.php";

$musicXML = new MusicXML();
try
{
    $midi = $musicXML->loadMidi("test.mid");
    $mxl = $musicXML->midiToMusicXml($midi, "Test", "4.0", "mxl");
    file_put_contents("convert.mxl", $mxl);
}
catch(Exception $e)
{
    echo $e->getMessage();  
}
```

## Progress

1. October 5th 2023 - result is playable but duration longer than expected
2. October 9th 2023 - 21 percent (95 of 444) elements created
3. October 10th 2023 - 53 percent (235 of 444) elements created
4. October 11th 2023 - 100 percent elements created
5. April 26th 2026 - Success convert complex MIDI into MusicXML with many notes

## Support Is Required

Support us to develop this library and subscribe our YouTube channel at https://www.youtube.com/@MusicPlanetbiru

## Special Thanks

Thank you https://github.com/robbie-cao/ for your library at https://github.com/robbie-cao/midi-class-php/. We learn much about MIDI file format and using code from your library and attach it to our code. We need MIDI parser before create MusicXML file from a MIDI file.
