<?php

namespace MusicXML;

use Exception;
use SimpleXMLElement;

class MusicConverter
{
    private $fontFamily = 'Times';

    /**
     * Convert MIDI file content to PDF file content using pure PHP FPDF renderer
     *
     * @param string $midiData Raw MIDI string data
     * @param string $songTitle Song title for the score
     * @param string $composer Composer name for the score
     * @param int|string|null $targetChannelOrPartId Optional specific MIDI channel number (1-16) or MusicXML Part ID to render
     * @param bool $compressEmptyMeasures Optional flag to collapse consecutive empty measures into multi-measure rests
     * @return string Raw PDF data string
     * @throws Exception
     */
    public function midiToPdf($midiData, $songTitle = "Untitled", $composer = "Unknown", $targetChannelOrPartId = null, $compressEmptyMeasures = false)
    {
        if (empty($midiData)) {
            throw new Exception("Invalid input MIDI data.");
        }

        // 1. Convert MIDI to MusicXML content using the PHP converter
        $converter = new MusicXMLFromMidi();
        $midi = $converter->loadMidiString($midiData);
        $xmlStr = $converter->midiToMusicXml($midi, $songTitle);
        
        return $this->musicXmlToPdf($xmlStr, $songTitle, $composer, $targetChannelOrPartId, $compressEmptyMeasures);
    }

    /**
     * Convert MusicXML string content to PDF file content using pure PHP FPDF renderer
     *
     * @param string $xmlStr MusicXML string content
     * @param string $songTitle Song title for the score
     * @param string $composer Composer name for the score
     * @param int|string|null $targetChannelOrPartId Optional specific MIDI channel number (1-16) or MusicXML Part ID to render
     * @param bool $compressEmptyMeasures Optional flag to collapse consecutive empty measures into multi-measure rests
     * @return string Raw PDF data string
     * @throws Exception
     */
    public function musicXmlToPdf($xmlStr, $songTitle = "Untitled", $composer = "Unknown", $targetChannelOrPartId = null, $compressEmptyMeasures = false)
    {
        if (empty($xmlStr)) {
            throw new Exception("Invalid input MusicXML data.");
        }

        // 2. Parse the MusicXML content
        $xml = simplexml_load_string($xmlStr);
        if ($xml === false) {
            throw new Exception("Failed to parse generated MusicXML content.");
        }

        // 3. Resolve Part ID from target channel or part ID
        $partId = null;
        if ($targetChannelOrPartId !== null) {
            if (is_numeric($targetChannelOrPartId)) {
                $targetChannel = (int)$targetChannelOrPartId;
                foreach ($xml->{'part-list'}->{'score-part'} as $scorePart) {
                    $partIdVal = (string)$scorePart['id'];
                    foreach ($scorePart->{'midi-instrument'} as $midiInst) {
                        if (isset($midiInst->{'midi-channel'}) && (int)$midiInst->{'midi-channel'} === $targetChannel) {
                            $partId = $partIdVal;
                            break 2;
                        }
                    }
                }
                // Fallback: if not matched inside midi-instrument channels, try P<channel>
                if ($partId === null) {
                    $partId = 'P' . $targetChannel;
                }
            } else {
                $partId = $targetChannelOrPartId;
            }
        }

        if ($partId === null) {
            $partId = $this->detectBestPart($xml);
        }

        $tempoMap = array();
        if (isset($xml->part)) {
            foreach ($xml->part as $part) {
                if (isset($part->measure)) {
                    $mIdx = 0;
                    foreach ($part->measure as $measure) {
                        if (isset($measure->direction)) {
                            foreach ($measure->direction as $direction) {
                                if (isset($direction->sound) && isset($direction->sound['tempo'])) {
                                    $tempoMap[$mIdx] = round((float)$direction->sound['tempo']);
                                }
                                if (isset($direction->{'direction-type'}->metronome->{'per-minute'})) {
                                    $tempoMap[$mIdx] = round((float)$direction->{'direction-type'}->metronome->{'per-minute'});
                                }
                            }
                        }
                        $mIdx++;
                    }
                }
            }
        }

        $firstTempo = 120;
        foreach ($tempoMap as $m => $t) {
            $firstTempo = $t;
            break;
        }
        if (!isset($tempoMap[0])) {
            $tempoMap[0] = $firstTempo;
        }

        // 4. Render the part to PDF
        return $this->renderPartToPdf($xml, $partId, $songTitle, $composer, $tempoMap, $compressEmptyMeasures);             
    }

    /**
     * Detect the best part to render (prefer track with lyrics, then track with most notes)
     *
     * @param SimpleXMLElement $xml
     * @return string Part ID
     */
    private function detectBestPart($xml)
    {
        $bestPartId = 'P1';
        $maxLyrics = -1;
        $maxNotes = -1;
        
        foreach ($xml->part as $part) {
            $partId = (string)$part['id'];
            $lyricsCount = 0;
            $notesCount = 0;
            foreach ($part->measure as $measure) {
                foreach ($measure->note as $note) {
                    if (isset($note->lyric)) {
                        $lyricsCount++;
                    }
                    if (isset($note->pitch) || isset($note->unpitched)) {
                        $notesCount++;
                    }
                }
            }
            
            if ($lyricsCount > $maxLyrics) {
                $maxLyrics = $lyricsCount;
                $bestPartId = $partId;
            }
            if ($lyricsCount == 0 && $notesCount > $maxNotes) {
                $maxNotes = $notesCount;
                if ($maxLyrics <= 0) {
                    $bestPartId = $partId;
                }
            }
        }
        
        return $bestPartId;
    }

    /**
     * Render the selected part to a PDF file
     *
     * @param SimpleXMLElement $xml
     * @param string $partId
     * @param string $songTitle
     * @param string $composer
     * @param int|null $bpm
     * @return string
     * @throws Exception
     */
    private function renderPartToPdf($xml, $partId, $songTitle, $composer, $tempoMap = array(), $compressEmptyMeasures = false)
    {
        // Find part element and part name
        $targetPart = null;
        foreach ($xml->part as $part) {
            if ((string)$part['id'] === $partId) {
                $targetPart = $part;
                break;
            }
        }

        if ($targetPart === null) {
            throw new Exception("Part $partId not found in MusicXML.");
        }

        // Get part display name
        $partNameStr = "Score";
        foreach ($xml->{'part-list'}->{'score-part'} as $scorePart) {
            if ((string)$scorePart['id'] === $partId) {
                $partNameStr = (string)$scorePart->{'part-name'};
                break;
            }
        }

        // Initialize PDF renderer
        $pdf = new SheetMusicPDF('P', 'mm', 'A4');
        $pdf->composer = $composer;
        $pdf->year = date('Y');
        $pdf->AliasNbPages();
        $pdf->SetAutoPageBreak(false);
        $pdf->AddPage();

        // Draw title section on first page
        $pdf->SetFont($this->fontFamily, 'B', 14);
        $pdf->Cell(0, 8, $songTitle, 0, 1, 'C');
        $pdf->SetFont($this->fontFamily, 'I', 9);
        $pdf->Cell(0, 5, $partNameStr, 0, 1, 'C');
        $pdf->SetFont($this->fontFamily, '', 7);
        $pdf->Cell(0, 4, $composer, 0, 1, 'C');
        $pdf->Ln(4);

        // Detect if the target part has lyrics
        $hasLyrics = false;
        foreach ($targetPart->measure as $measure) {
            foreach ($measure->note as $note) {
                if (isset($note->lyric)) {
                    $hasLyrics = true;
                    break 2;
                }
            }
        }

        // Grid parameters
        $tempoOffset = -8.5; // shift tempo text slightly left to avoid overlapping with barline
        $systemX = 12; // horizontal start on page 1
        $systemY = 40; // vertical start on page 1
        $measuresPerSystem = $hasLyrics ? 2 : 3;
        $printableWidth = 185; // A4 width 210mm - 15mm left margin - 11mm right margin
        $lineSpacing = 2; // distance between staff lines in mm

        // Default attributes
        $divisions = 4;
        $fifths = 0;
        $beats = 4;
        $beatType = 4;
        
        // Detect if it is percussion track
        $isPercussion = (stripos($partNameStr, 'drum') !== false || stripos($partNameStr, 'percussion') !== false);

        $measures = $targetPart->measure;
        $totalMeasures = count($measures);

        $measureLayoutIdx = array();
        $collapseCount = array();
        $currLayoutIdx = 0;
        for ($i = 0; $i < $totalMeasures; $i++) {
            $measureLayoutIdx[$i] = $currLayoutIdx;
            
            $c = 1;
            if ($compressEmptyMeasures) {
                // Check if measure $i is blank
                $isBlank = true;
                if (isset($measures[$i]->note)) {
                    foreach ($measures[$i]->note as $note) {
                        if (!isset($note->rest)) {
                            $isBlank = false;
                            break;
                        }
                    }
                }
                
                if ($isBlank) {
                    while ($i + $c < $totalMeasures) {
                        $nextMeasure = $measures[$i + $c];
                        $nextIsBlank = true;
                        if (isset($nextMeasure->note)) {
                            foreach ($nextMeasure->note as $note) {
                                if (!isset($note->rest)) {
                                    $nextIsBlank = false;
                                    break;
                                }
                            }
                        }
                        if (!$nextIsBlank) {
                            break;
                        }
                        if (isset($nextMeasure->attributes)) {
                            break;
                        }
                        $c++;
                    }
                }
            }
            
            if ($c > 1) {
                $collapseCount[$i] = $c;
                for ($j = 0; $j < $c; $j++) {
                    $measureLayoutIdx[$i + $j] = $currLayoutIdx;
                }
                $i += $c - 1;
            } else {
                $collapseCount[$i] = 1;
            }
            $currLayoutIdx++;
        }

        $activeTies = array();

        for ($mIdx = 0; $mIdx < $totalMeasures; $mIdx++) {
            $measure = $measures[$mIdx];
            
            // Check attributes if defined in this measure
            if (isset($measure->attributes)) {
                if (isset($measure->attributes->divisions)) {
                    $divisions = (int)$measure->attributes->divisions;
                }
                if (isset($measure->attributes->key->fifths)) {
                    $fifths = (int)$measure->attributes->key->fifths;
                }
                if (isset($measure->attributes->time->beats)) {
                    $beats = (int)$measure->attributes->time->beats;
                }
                if (isset($measure->attributes->time->{'beat-type'})) {
                    $beatType = (int)$measure->attributes->time->{'beat-type'};
                }
                if (isset($measure->attributes->clef->sign)) {
                    $isPercussion = ((string)$measure->attributes->clef->sign === 'percussion');
                }
            }

            $measureDuration = $beats * $divisions;
            if ($measureDuration <= 0) $measureDuration = 16;

            $layoutIdx = $measureLayoutIdx[$mIdx];

            // Indent for clef and signatures at the start of each system
            $systemStartIndent = ($layoutIdx < $measuresPerSystem) ? 22 : 16;
            $measureWidth = ($printableWidth - $systemStartIndent) / $measuresPerSystem;

            // Start of a new system
            if ($layoutIdx % $measuresPerSystem == 0) {
                // If system goes off-page, start new page
                if ($systemY + 28 > 265) {
                    $pdf->AddPage();
                    $systemY = 20; // reset system Y for subsequent pages
                }

                // Draw 5 staff lines from systemX to systemX + printableWidth
                $pdf->SetDrawColor(180, 180, 180);
                $pdf->SetLineWidth(0.15);
                for ($line = 0; $line < 5; $line++) {
                    $ly = $systemY + $line * $lineSpacing;
                    $pdf->Line($systemX, $ly, $systemX + $printableWidth, $ly);
                }
                $pdf->SetDrawColor(0, 0, 0);
                $pdf->SetLineWidth(0.2);

                // Draw Clef
                if ($isPercussion) {
                    $pdf->DrawPercussionClef($systemX, $systemY);
                } else {
                    $pdf->DrawTrebleClef($systemX, $systemY);
                }

                // Draw Key Signature (flats/sharps)
                if ($fifths == -1 && !$isPercussion) {
                    // 1 flat (Bb4) on middle line
                    $pdf->DrawFlat($systemX + 9, $systemY + 4);
                } elseif ($fifths == 1 && !$isPercussion) {
                    // 1 sharp (F#5) on top line
                    $pdf->DrawSharp($systemX + 9, $systemY);
                }

                // Draw Time Signature (first measure of page or song)
                if ($layoutIdx == 0) {
                    $pdf->SetFont($this->fontFamily, 'B', 10);
                    $pdf->SetXY($systemX + 15, $systemY);
                    $pdf->Cell(6, 4, $beats, 0, 0, 'C');
                    $pdf->SetXY($systemX + 15, $systemY + 4);
                    $pdf->Cell(6, 4, $beatType, 0, 0, 'C');
                }
            }

            // Calculate current measure start coordinate
            $currentMeasureX = $systemX + $systemStartIndent + (($layoutIdx % $measuresPerSystem) * $measureWidth);

            // Draw Tempo from tempoMap if present for this measure
            if (isset($tempoMap[$mIdx])) {
                $bpmVal = $tempoMap[$mIdx];
                $pdf->SetFont($this->fontFamily, 'B', 8);
                $pdf->SetXY($currentMeasureX + $tempoOffset - 2, $systemY - 6.5);
                $pdf->Cell(10, 3, "Tempo: ", 0, 0, 'L');
                
                // Draw a tiny quarter note
                $noteX = $currentMeasureX + 10.5;
                $pdf->Ellipse($noteX + $tempoOffset, $systemY - 4.5, 1.035, 0.65, 'FD', 15);
                $pdf->SetLineWidth(0.2);
                $pdf->SetDrawColor(0, 0, 0);
                $pdf->Line($noteX + $tempoOffset + 1, $systemY - 4.8, $noteX + $tempoOffset + 1, $systemY - 7.5);
                
                // Draw the "= 120" text
                $pdf->SetXY($noteX + $tempoOffset + 1.8, $systemY - 6.5);
                $pdf->Cell(15, 3, "= " . $bpmVal, 0, 0, 'L');
            }

            // Draw vertical barlines (slightly longer and darker for better visibility)
            $pdf->SetLineWidth(0.35);
            $pdf->SetDrawColor(0, 0, 0);
            if ($layoutIdx % $measuresPerSystem == 0) {
                // Draw left barline of first measure in system
                $pdf->Line($currentMeasureX, $systemY - 0.5, $currentMeasureX, $systemY + 8.5);
            }
            // Draw right barline of measure
            $pdf->Line($currentMeasureX + $measureWidth, $systemY - 0.5, $currentMeasureX + $measureWidth, $systemY + 8.5);
            $pdf->SetLineWidth(0.2);

            // Handle Multi-measure Rest compression
            $c = isset($collapseCount[$mIdx]) ? $collapseCount[$mIdx] : 1;
            if ($c > 1) {
                // Draw Multi-measure Rest (church rest)
                $pdf->SetLineWidth(1.2);
                $pdf->SetDrawColor(0, 0, 0);
                $restStartY = $systemY + 4.0; // middle staff line (B4)
                $restStartX = $currentMeasureX + 8.0;
                $restEndX = $currentMeasureX + $measureWidth - 8.0;
                
                // Horizontal thick bar
                $pdf->Line($restStartX, $restStartY, $restEndX, $restStartY);
                
                // Vertical end ticks
                $pdf->SetLineWidth(0.4);
                $pdf->Line($restStartX, $restStartY - 1.5, $restStartX, $restStartY + 1.5);
                $pdf->Line($restEndX, $restStartY - 1.5, $restEndX, $restStartY + 1.5);
                
                // Draw the number above the staff
                $pdf->SetFont($this->fontFamily, 'B', 10);
                $pdf->SetXY($currentMeasureX, $systemY - 4.5);
                $pdf->Cell($measureWidth, 4, $c, 0, 0, 'C');

                // Move to next system if we hit measures limit per system
                if ($layoutIdx % $measuresPerSystem == $measuresPerSystem - 1) {
                    $systemY += 28;
                }

                $mIdx += $c - 1; // skip skipped measures in the XML loop
                continue; // skip drawing notes for this group
            }

            // Draw notes in measure
            $currentDiv = 0;
            $lastDuration = 0;

            foreach ($measure->note as $note) {
                $duration = isset($note->duration) ? (int)$note->duration : 0;
                
                // Handle chords: chords align with the start of the previous note
                $isChord = isset($note->chord);
                if ($isChord) {
                    $currentDiv -= $lastDuration;
                }

                // Calculate note X coordinate (with 2mm padding on left/right margins of the measure to avoid barline clashes)
                $padding = 2.0;
                $xRange = $measureWidth - ($padding * 2);
                if ($xRange < 5) $xRange = 5; // prevent division/range anomalies
                $xOffset = $padding + ($currentDiv / $measureDuration) * $xRange;
                $noteX = $currentMeasureX + $xOffset;

                // Draw Rest Note
                if (isset($note->rest)) {
                    $pdf->SetDrawColor(0, 0, 0);
                    if ($duration >= $measureDuration) {
                        // Whole rest: box hanging from line 4 (D5, which is systemY + 6.0)
                        $pdf->Rect($noteX - 2.0, $systemY + 6.0, 4.0, 1.5, 'F');
                    } elseif ($duration >= $measureDuration / 2) {
                        // Half rest: box sitting on line 3 (B4, which is systemY + 4.0)
                        $pdf->Rect($noteX - 2.0, $systemY + 2.5, 4.0, 1.5, 'F');
                    } else {
                        $typeStr = isset($note->type) ? (string)$note->type : 'quarter';
                        if ($typeStr === 'quarter' || $typeStr === '1/4') {
                             // Enhanced vector quarter rest with smooth, untwisted bottom hook
                             $quarterPath = "M 50 10 C 60 40, 30 60, 50 80 C 70 100, 40 120, 60 150 C 65 170, 45 185, 25 180 C 23 180, 24 176, 28 176 C 35 170, 45 155, 50 140 C 30 110, 60 90, 40 70 C 20 50, 40 20, 50 10 Z";
                             $pdf->DrawSVGPath($quarterPath, $noteX - 2.25, $systemY + 0.7, 0.045, 0.033, true);
                        } else {
                            // Eighth, 16th, and 32nd rests with elegant bezier hooks and slanted diagonal stems
                            $pdf->SetLineWidth(0.35);
                            // Prominent, beautiful hook shape to avoid looking straight when printed
                            $hookPath = "M 0 0 C -1.0 -1.5, -2.8 -1.2, -2.8 0.5 C -2.8 2.0, -1.2 1.6, -0.4 0.2 Z";
                            if ($typeStr === 'eighth' || $typeStr === '1/8') {
                                $pdf->Line($noteX + 0.5, $systemY + 5.0, $noteX - 0.5, $systemY + 1.0);
                                $pdf->DrawSVGPath($hookPath, $noteX + 0.5, $systemY + 5.0, 1.0, 1.0, true);
                            } elseif ($typeStr === '16th' || $typeStr === '1/16') {
                                $pdf->Line($noteX + 0.5, $systemY + 5.0, $noteX - 0.7, $systemY + 0.5);
                                $pdf->DrawSVGPath($hookPath, $noteX + 0.5, $systemY + 5.0, 1.0, 1.0, true);
                                $pdf->DrawSVGPath($hookPath, $noteX + 0.0, $systemY + 3.0, 1.0, 1.0, true);
                            } else {
                                // 32nd rest or shorter
                                $pdf->Line($noteX + 0.5, $systemY + 5.0, $noteX - 0.9, $systemY - 0.5);
                                $pdf->DrawSVGPath($hookPath, $noteX + 0.5, $systemY + 5.0, 1.0, 1.0, true);
                                $pdf->DrawSVGPath($hookPath, $noteX + 0.0, $systemY + 3.0, 1.0, 1.0, true);
                                $pdf->DrawSVGPath($hookPath, $noteX - 0.5, $systemY + 1.0, 1.0, 1.0, true);
                            }
                            $pdf->SetLineWidth(0.2);
                        }
                    }
                } 
                // Draw Sound Note (pitched or unpitched)
                else {
                    $pitchVal = 71; // Default middle B4
                    $hasAlter = false;
                    $alterVal = 0;
                    $notehead = 'normal';

                    if (isset($note->pitch)) {
                        $step = (string)$note->pitch->step;
                        $octave = (int)$note->pitch->octave;
                        $pitchVal = $this->getPitchValue($step, $octave);
                        if (isset($note->pitch->alter)) {
                            $hasAlter = true;
                            $alterVal = (int)$note->pitch->alter;
                        }
                    } elseif (isset($note->unpitched)) {
                        $step = (string)$note->unpitched->{'display-step'};
                        $octave = (int)$note->unpitched->{'display-octave'};
                        $pitchVal = $this->getPitchValue($step, $octave);
                    }

                    if (isset($note->notehead)) {
                        $notehead = (string)$note->notehead;
                    }

                    // Get Treble staff diatonic step
                    $stepIndex = $this->getTrebleStep($pitchVal);
                    // notehead center Y coordinate
                    $noteY = $systemY + 8 - ($stepIndex * 1.0);

                    // Draw accidentals if any (sharp/flat)
                    if ($hasAlter && !$isPercussion) {
                        if ($alterVal > 0) {
                            $pdf->DrawSharp($noteX - 2.8, $noteY);
                        } elseif ($alterVal < 0) {
                            $pdf->DrawFlat($noteX - 2.8, $noteY);
                        }
                    }

                    // Draw Ledger Lines
                    if ($stepIndex <= -2) {
                        for ($lineIdx = -2; $lineIdx >= $stepIndex; $lineIdx -= 2) {
                            $ly = $systemY + 8 - ($lineIdx * 1.0);
                            $pdf->Line($noteX - 3, $ly, $noteX + 3, $ly);
                        }
                    } elseif ($stepIndex >= 10) {
                        for ($lineIdx = 10; $lineIdx <= $stepIndex; $lineIdx += 2) {
                            $ly = $systemY + 8 - ($lineIdx * 1.0);
                            $pdf->Line($noteX - 3, $ly, $noteX + 3, $ly);
                        }
                    }

                    // Draw Notehead
                    $typeStr = isset($note->type) ? (string)$note->type : 'quarter';
                    $style = ($typeStr === 'half' || $typeStr === 'whole') ? 'D' : 'FD';
                    

                    if ($notehead === 'x') {
                        // Draw 'x' for hi-hats/cymbals
                        $pdf->SetLineWidth(0.35);
                        $pdf->Line($noteX - 1.2, $noteY - 1.2, $noteX + 1.2, $noteY + 1.2);
                        $pdf->Line($noteX - 1.2, $noteY + 1.2, $noteX + 1.2, $noteY - 1.2);
                        $pdf->SetLineWidth(0.2);
                    } elseif ($notehead === 'slash') {
                        // Draw diagonal slash notehead
                        $pdf->SetLineWidth(0.35);
                        $pdf->Line($noteX - 1.2, $noteY + 1.2, $noteX + 1.2, $noteY - 1.2);
                        $pdf->SetLineWidth(0.2);
                    } else {
                        // Draw normal oval/tilted notehead
                        $pdf->SetLineWidth(0.35);
                        $pdf->Ellipse($noteX, $noteY, 1.55, 0.92, $style, 15);
                    }

                    // Determine stem direction (used for stem drawing and ties)
                    $stemDir = 'up';

                    $stemDir = ($stepIndex >= 4) ? 'down' : 'up';

                    // Draw Stem (for all types except whole notes)
                    // Draw Stem (for all types except whole notes)
                    if ($typeStr !== 'whole') {
                        $pdf->SetLineWidth(0.35);
                        if ($stemDir === 'up') {
                            $stemEndY = $noteY - 8.5;
                            $pdf->Line($noteX + 1.512, $noteY - 0.4, $noteX + 1.512, $stemEndY);
                            $pdf->DrawNoteFlag($noteX + 1.56, $stemEndY, 'up', $typeStr);
                        } else {
                            $stemEndY = $noteY + 8.5;
                            $pdf->Line($noteX - 1.512, $noteY + 0.4, $noteX - 1.512, $stemEndY);
                            $pdf->DrawNoteFlag($noteX - 1.56, $stemEndY, 'down', $typeStr);
                        }

                        $pdf->SetLineWidth(0.2);
                    }

                    // Draw Tie / Tied Stop
                    $isTieStop = false;
                    if (isset($note->tie)) {
                        foreach ($note->tie as $t) {
                            if ((string)$t['type'] === 'stop') {
                                $isTieStop = true;
                            }
                        }
                    }
                    if (isset($note->notations->tied)) {
                        foreach ($note->notations->tied as $t) {
                            if ((string)$t['type'] === 'stop') {
                                $isTieStop = true;
                            }
                        }
                    }

                    if ($isTieStop && isset($activeTies[$pitchVal])) {
                        $startNote = $activeTies[$pitchVal];
                        unset($activeTies[$pitchVal]); // consumed
                        
                        $startSystemIdx = (int)($measureLayoutIdx[$startNote['measureIdx']] / $measuresPerSystem);
                        $endSystemIdx = (int)($measureLayoutIdx[$mIdx] / $measuresPerSystem);
                        
                        if ($startSystemIdx === $endSystemIdx) {
                            // Same system - draw single tie curve
                            $bendDir = ($startNote['stemDir'] === 'up') ? 'down' : 'up';
                            $sx = $startNote['x'] + 1.2;
                            $ex = $noteX - 1.2;
                            $sy = ($bendDir === 'down') ? ($startNote['y'] + 0.5) : ($startNote['y'] - 0.5);
                            $ey = ($bendDir === 'down') ? ($noteY + 0.5) : ($noteY - 0.5);
                            
                            $pdf->DrawTie($sx, $sy, $ex, $ey, $bendDir);
                        } else {
                            // Different systems - draw the second segment (starts to the left of the notehead)
                            $bendDir = ($stemDir === 'up') ? 'down' : 'up';
                            $ex = $noteX - 1.2;
                            $ey = ($bendDir === 'down') ? ($noteY + 0.5) : ($noteY - 0.5);
                            
                            // Start the incoming tie curve 6.5mm to the left of the notehead
                            // to ensure it is clearly visible and crosses the barline.
                            $sx = $noteX - 6.5;
                            $sy = $ey; // keep it horizontal
                            
                            $pdf->DrawTie($sx, $sy, $ex, $ey, $bendDir);
                        }
                    }

                    // Draw Tie / Tied Start
                    $isTieStart = false;
                    if (isset($note->tie)) {
                        foreach ($note->tie as $t) {
                            if ((string)$t['type'] === 'start') {
                                $isTieStart = true;
                            }
                        }
                    }
                    if (isset($note->notations->tied)) {
                        foreach ($note->notations->tied as $t) {
                            if ((string)$t['type'] === 'start') {
                                $isTieStart = true;
                            }
                        }
                    }

                    if ($isTieStart) {
                        // Store starting tie info
                        $activeTies[$pitchVal] = array(
                            'x' => $noteX,
                            'y' => $noteY,
                            'stemDir' => $stemDir,
                            'measureIdx' => $mIdx
                        );
                        
                        // Find matching stop note to see if they are in different systems
                        $stopMeasureIdx = -1;
                        for ($i = $mIdx + 1; $i < $totalMeasures; $i++) {
                            $meas = $measures[$i];
                            foreach ($meas->note as $n) {
                                $nPitch = 71;
                                if (isset($n->pitch)) {
                                    $nStep = (string)$n->pitch->step;
                                    $nOct = (int)$n->pitch->octave;
                                    $nPitch = $this->getPitchValue($nStep, $nOct);
                                } elseif (isset($n->unpitched)) {
                                    $nStep = (string)$n->unpitched->{'display-step'};
                                    $nOct = (int)$n->unpitched->{'display-octave'};
                                    $nPitch = $this->getPitchValue($nStep, $nOct);
                                }
                                
                                if ($nPitch === $pitchVal) {
                                    $hasStop = false;
                                    if (isset($n->tie)) {
                                        foreach ($n->tie as $t) {
                                            if ((string)$t['type'] === 'stop') $hasStop = true;
                                        }
                                    }
                                    if (isset($n->notations->tied)) {
                                        foreach ($n->notations->tied as $t) {
                                            if ((string)$t['type'] === 'stop') $hasStop = true;
                                        }
                                    }
                                    if ($hasStop) {
                                        $stopMeasureIdx = $i;
                                        break 2;
                                    }
                                }
                            }
                        }
                        
                        if ($stopMeasureIdx !== -1) {
                            $startSystemIdx = (int)($measureLayoutIdx[$mIdx] / $measuresPerSystem);
                            $endSystemIdx = (int)($measureLayoutIdx[$stopMeasureIdx] / $measuresPerSystem);
                            
                            if ($startSystemIdx !== $endSystemIdx) {
                                // Different systems - draw the first segment immediately
                                $bendDir = ($stemDir === 'up') ? 'down' : 'up';
                                $sx = $noteX + 1.2;
                                $sy = ($bendDir === 'down') ? ($noteY + 0.5) : ($noteY - 0.5);
                                
                                $ex = $currentMeasureX + $measureWidth - 1;
                                $ey = $sy; // keep it horizontal
                                
                                $pdf->DrawTie($sx, $sy, $ex, $ey, $bendDir);
                            }
                        }
                    }

                    // Draw Lyric Text below the system (margin increased to 16.5mm to completely avoid notehead overlaps, font size reduced to 6.0 for better spacing)
                    if (isset($note->lyric) && isset($note->lyric->text)) {
                        $lyricText = (string)$note->lyric->text;
                        $pdf->SetFont($this->fontFamily, '', 9.0);
                        $pdf->SetXY($noteX - 15, $systemY + 16.5);
                        $pdf->Cell(30, 3, $lyricText, 0, 0, 'C');
                    }
                }

                $lastDuration = $duration;
                $currentDiv += $duration;
            }

            // Move to next system if we hit measures limit per system
            if ($layoutIdx % $measuresPerSystem == $measuresPerSystem - 1) {
                $systemY += 28;
            }
        }

        return $pdf->Output('S');
    }

    /**
     * Map MIDI pitch to staff diatonic step index (E4 = 0)
     *
     * @param int $noteNumber
     * @return int
     */
    private function getTrebleStep($noteNumber)
    {
        $pitchClasses = array(
            0 => 0,  // C
            1 => 0,  // C#
            2 => 1,  // D
            3 => 1,  // D#
            4 => 2,  // E
            5 => 3,  // F
            6 => 3,  // F#
            7 => 4,  // G
            8 => 4,  // G#
            9 => 5,  // A
            10 => 5, // A#
            11 => 6  // B
        );
        
        $pc = $noteNumber % 12;
        $oct = (int) floor($noteNumber / 12);
        
        // E4 (MIDI 64): pc = 4, oct = 5.
        // Let's calculate: (5 * 7) + 2 - 37 = 0.
        return ($oct * 7) + $pitchClasses[$pc] - 37;
    }

    /**
     * Map MIDI Step and Octave to pitch value
     *
     * @param string $step C, D, E, F, G, A, B
     * @param int $octave
     * @return int
     */
    private function getPitchValue($step, $octave)
    {
        $stepMap = array('C' => 0, 'D' => 2, 'E' => 4, 'F' => 5, 'G' => 7, 'A' => 9, 'B' => 11);
        return 12 * ($octave + 1) + $stepMap[strtoupper($step)];
    }
}
