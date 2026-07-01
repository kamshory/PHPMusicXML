# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [1.0.0] - 2024-07-26

### Added

- **MIDI to MusicXML Conversion**: Core functionality to convert `.mid` files into MusicXML format (uncompressed `.xml` and compressed `.mxl`).
- **MusicXML 4.0 Model Support**: Comprehensive PHP class implementation for every element in the MusicXML 4.0 schema.
- **Channel Filtering**: Ability to select specific MIDI channels for conversion via the CLI argument (`--channels`).
- **Chord Detection**: Smart logic to detect and group simultaneously played notes as chords.
- **Percussion Support**: Automatic conversion for MIDI channel 10 to standard MusicXML percussion notation, including visual mapping for drums (e.g., `x` noteheads for cymbals).
- **Advanced Lyric Handling**:
  - Prevents lyric overlaps by dynamically adjusting note horizontal positions (`default-x`).
  - Automatically centers lyrics under noteheads.
  - Lyric placement convention on Channel 4 for better compatibility with notation software.
- **Rhythm Correction**: Implemented quantization to clean up small timing variations in MIDI files, resulting in neater and more readable rhythms.
- **Dynamic Volume Calculation**: Calculates note volume based on a combination of *velocity*, *CC7 (Volume)*, and *CC11 (Expression)* for a more accurate dynamic representation.
- **Command-Line Interface (CLI)**: User-friendly `convert.php` script for single-file and bulk directory conversions.
- **Library Support**: Ability to integrate PHPMusicXML directly into PHP projects for custom conversion functionality.
- **MIDI to PDF Conversion**: Experimental capability to generate PDF files directly from MIDI for printing sheet music.

### Changed

- Project structure organized with models, properties, and utilities under the `MusicXML` namespace.

### Fixed

- Fixed an issue where note durations were longer than expected in early development versions.
- Fixed drum sound mapping for more accurate representation.