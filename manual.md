# PHPMusicXML User Manual

PHPMusicXML is a PHP-based library designed to convert MIDI files into MusicXML format. It specializes in producing clean, readable sheet music with a particular focus on preventing lyric overlaps and ensuring proper note spacing.

## Prerequisites

- **PHP**: Version 7.4 or higher.
- **Environment**: Accessible via Command Line Interface (CLI/Terminal).

## Basic Usage

The primary entry point for the converter is the `convert.php` script. You can run it from your terminal using the PHP CLI.

### Convert a Single File
To convert a MIDI file and generate an XML file in the same directory:
```bash
php convert.php "path/to/your/song.mid"
```
*This will create `song.xml` automatically.*

### Specify Output Path
To define a specific name or location for the resulting MusicXML file:
```bash
php convert.php "input.mid" "output_folder/score.xml"
```

## Advanced Features

### 1. Channel Selection
By default, all channels in the MIDI file are converted. If you only need specific instruments (e.g., just the melody or vocal track), use the `--channels` flag followed by a comma-separated list of channel IDs (1-16).

**Convert only Channel 4:**
```bash
php convert.php "song.mid" --channels=4
```

**Convert multiple specific channels (e.g., 1, 4, and 10):**
```bash
php convert.php "song.mid" --channels=1,4,10
```

### 2. Batch/Directory Conversion
To convert all MIDI files within a specific folder at once, use the `--dir` flag:
```bash
php convert.php --dir="my_midi_library"
```
*Note: You can combine this with the `--channels` flag to apply the same filter to all files in the directory.*

## Layout and Formatting Logic

PHPMusicXML includes built-in "interventions" to ensure that the generated MusicXML looks professional when opened in notation software like **MuseScore**, **Sibelius**, or **Finale**:

- **Lyric Overlap Prevention**: The library calculates the physical width required for lyrics. It intervenes by setting absolute horizontal coordinates (`default-x`) for notes to ensure that long syllables do not collide.
- **Proportional Spacing**: Regardless of note duration, the converter allocates a "portion" of horizontal space for every note onset, preventing clusters of short notes (like 1/32nd notes) from overlapping.
- **Lyric Alignment**: Lyrics are automatically centered under the note heads for better readability.
- **Vocal Convention**: Following standard MuseScore conventions, lyrics are primarily attached to **Channel 4**. However, the spacing logic respects lyrics across all selected channels to maintain vertical alignment.
- **Percussion Support**: Channel 10 events are automatically mapped to standard percussion notation (e.g., Kick drum on F4, Snare on C5).

## Troubleshooting and Notes

- **Missing Lyrics**: Ensure your MIDI file contains "Lyric" or "Text" meta-events.
- **Chord Detection**: Chords are detected based on identical absolute timestamps. If notes are slightly offset in the MIDI, they may be rendered as separate sequential notes rather than a chord.
- **Default Directory**: If run without any arguments, the script defaults to scanning the `test-files/` directory within the project folder.

## Compressed MusicXML (MXL)

If you require the compressed `.mxl` format, you can utilize the `midiToMusicXml` method within your own PHP implementation by passing the `MXL::FORMAT_MXL` constant:

```php
use MusicXML\MusicXMLFromMidi;
use MusicXML\Util\MXL;

$converter = new MusicXMLFromMidi();
$midi = $converter->loadMidi('input.mid');
$mxlContent = $converter->midiToMusicXml($midi, 'Title', '4.0', MXL::FORMAT_MXL);
file_put_contents('output.mxl', $mxlContent);
```
