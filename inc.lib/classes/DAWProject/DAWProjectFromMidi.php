<?php

namespace DAWProject;

use Midi\MidiMeasure;
use SimpleXMLElement;
use ZipArchive;

class DAWProjectFromMidi
{
    /**
     * Convert MIDI string to DAWProject ZIP content
     *
     * @param string $midiData
     * @param string $songTitle
     * @param array $selectedChannels array of channels to include (0-based)
     * @return string ZIP binary content
     */
    public function convert($midiData, $songTitle = "Untitled", $selectedChannels = null)
    {
        // Parse MIDI data
        $midi = new MidiMeasure();
        $midi->parseMidi($midiData);
        $timebase = $midi->getTimebase();

        // 1. Create project.xml
        $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><Project xmlns="http://www.bitwig.com/dawproject" version="1.0"></Project>');
        $xml->addChild('Application')->addAttribute('name', 'PHPMidi');
        $xml->children()->Application->addAttribute('version', '1.0');

        // Find tempo (default to 120 if none)
        $bpm = 120.0;
        $tempoEvents = $midi->getTempoEvents();
        if (!empty($tempoEvents)) {
            $bpm = $tempoEvents[0]->bpm;
        }
        $transport = $xml->addChild('Transport');
        $tempo = $transport->addChild('Tempo');
        $tempo->addAttribute('value', $bpm);

        $structure = $xml->addChild('Structure');
        $arrangement = $xml->addChild('Arrangement');
        $arrangement->addAttribute('id', 'A1');
        $lanes = $arrangement->addChild('Lanes');

        // Helper to convert ticks to beats
        // beats = ticks / timebase
        $ticksToBeats = function($ticks) use ($timebase) {
            return $ticks / $timebase;
        };

        // Go through MIDI tracks
        $tracks = $midi->getTracks();
        $trackCount = count($tracks);

        $trackIdCounter = 1;

        for ($i = 0; $i < $trackCount; $i++) {
            $rawTrack = $tracks[$i];
            
            // Collect notes and track name
            $trackName = "Track " . $i;
            $notes = array();
            
            // Keep track of active note on events
            $activeNotes = array();
            
            // Guess track channel
            $trackChannel = 0;

            foreach ($rawTrack as $evtLine) {
                $parts = explode(' ', trim($evtLine));
                if (count($parts) < 2) continue;
                
                $tick = intval($parts[0]);
                $type = $parts[1];

                if ($type === 'Meta' && isset($parts[2]) && $parts[2] === 'TrkName') {
                    $rawName = implode(' ', array_slice($parts, 3));
                    $trackName = trim($rawName, '" ');
                }

                if ($type === 'On' || $type === 'Off') {
                    $ch = 0;
                    $note = 0;
                    $vol = 0;
                    foreach ($parts as $p) {
                        if (strpos($p, 'ch=') === 0) {
                            $ch = intval(substr($p, 3));
                        }
                        if (strpos($p, 'n=') === 0 || strpos($p, 'note=') === 0) {
                            $note = intval(substr($p, strpos($p, '=') + 1));
                        }
                        if (strpos($p, 'v=') === 0 || strpos($p, 'vol=') === 0) {
                            $vol = intval(substr($p, strpos($p, '=') + 1));
                        }
                    }

                    $trackChannel = $ch;

                    if ($type === 'On' && $vol > 0) {
                        $activeNotes[$note] = array(
                            'tick' => $tick,
                            'velocity' => $vol
                        );
                    } else {
                        if (isset($activeNotes[$note])) {
                            $startTick = $activeNotes[$note]['tick'];
                            $velocity = $activeNotes[$note]['velocity'];
                            unset($activeNotes[$note]);

                            $durationTicks = $tick - $startTick;
                            if ($durationTicks <= 0) $durationTicks = 1;

                            $notes[] = array(
                                'key' => $note,
                                'time' => $ticksToBeats($startTick),
                                'duration' => $ticksToBeats($durationTicks),
                                'velocity' => $velocity / 127.0,
                                'channel' => $ch
                            );
                        }
                    }
                }
            }

            // Skip if track channel is not selected
            if ($selectedChannels !== null && !in_array($trackChannel, $selectedChannels)) {
                continue;
            }

            // Skip tracks with no notes
            if (empty($notes)) {
                continue;
            }

            $trackId = "T" . $trackIdCounter;
            $channelId = "C" . $trackIdCounter;
            $trackIdCounter++;

            // Add Track to Structure
            $trackEl = $structure->addChild('Track');
            $trackEl->addAttribute('name', $trackName);
            $trackEl->addAttribute('contentType', 'notes');
            $trackEl->addAttribute('id', $trackId);
            
            $channelEl = $trackEl->addChild('Channel');
            $channelEl->addAttribute('id', $channelId);

            // Add Clips lane to Arrangement Lanes
            $clipsEl = $lanes->addChild('Clips');
            $clipsEl->addAttribute('track', $trackId);

            // Find min/max time to define clip boundaries
            $minTime = null;
            $maxTime = null;
            foreach ($notes as $n) {
                if ($minTime === null || $n['time'] < $minTime) $minTime = $n['time'];
                $endTime = $n['time'] + $n['duration'];
                if ($maxTime === null || $endTime > $maxTime) $maxTime = $endTime;
            }

            $clipEl = $clipsEl->addChild('Clip');
            $clipEl->addAttribute('name', $trackName);
            $clipEl->addAttribute('time', $minTime);
            $clipEl->addAttribute('duration', $maxTime - $minTime);

            $notesEl = $clipEl->addChild('Notes');
            
            foreach ($notes as $n) {
                // Time inside clip is relative to clip start
                $noteTimeInClip = $n['time'] - $minTime;
                
                $noteEl = $notesEl->addChild('Note');
                $noteEl->addAttribute('time', $noteTimeInClip);
                $noteEl->addAttribute('duration', $n['duration']);
                $noteEl->addAttribute('channel', $n['channel']);
                $noteEl->addAttribute('key', $n['key']);
                $noteEl->addAttribute('vel', round($n['velocity'], 4));
            }
        }

        // Format project.xml output
        $dom = dom_import_simplexml($xml)->ownerDocument;
        $dom->formatOutput = true;
        $projectXmlContent = $dom->saveXML();

        // 2. Create metadata.xml
        $metadataXml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><MetaData xmlns="http://www.bitwig.com/dawproject" version="1.0"></MetaData>');
        $metadataXml->addChild('Title', htmlspecialchars($songTitle));
        
        $domMeta = dom_import_simplexml($metadataXml)->ownerDocument;
        $domMeta->formatOutput = true;
        $metadataXmlContent = $domMeta->saveXML();

        // 3. Create ZIP archive
        $tempFile = tempnam(sys_get_temp_dir(), 'dawproj');
        $zip = new ZipArchive();
        if ($zip->open($tempFile, ZipArchive::CREATE | ZipArchive::OVERWRITE) === true) {
            $zip->addFromString('project.xml', $projectXmlContent);
            $zip->addFromString('metadata.xml', $metadataXmlContent);
            $zip->close();
        }

        $zipData = file_get_contents($tempFile);
        @unlink($tempFile);

        return $zipData;
    }
}
