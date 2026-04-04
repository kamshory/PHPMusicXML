<?php

namespace MusicXML;

use DateTime;
use DOMDocument;
use DOMImplementation;
use MusicXML\Model\Alter;
use MusicXML\Model\Articulations;
use MusicXML\Model\Beats;
use MusicXML\Model\BeatType;
use MusicXML\Model\Bend;
use MusicXML\Model\Encoder;
use MusicXML\Model\Encoding;
use MusicXML\Model\EncodingDate;
use MusicXML\Model\EncodingDescription;
use MusicXML\Model\Identification;
use MusicXML\Model\InstrumentName;
use MusicXML\Model\InstrumentSound;
use MusicXML\Model\Key;
use MusicXML\Model\MidiChannel;
use MusicXML\Model\MidiDevice;
use MusicXML\Model\MidiInstrument;
use MusicXML\Model\MidiProgram;
use MusicXML\Model\Notations;
use MusicXML\Model\Octave;
use MusicXML\Model\Pan;
use MusicXML\Model\PartAbbreviation;
use MusicXML\Model\PartName;
use MusicXML\Model\Pitch;
use MusicXML\Model\PreBend;
use MusicXML\Model\Release;
use MusicXML\Model\Rights;
use MusicXML\Model\ScoreInstrument;
use MusicXML\Model\ScorePart;
use MusicXML\Model\Software;
use MusicXML\Model\Staccato;
use MusicXML\Model\Step;
use MusicXML\Model\Supports;
use MusicXML\Model\Time;
use MusicXML\Model\Volume;
use MusicXML\Properties\TimeSignature;

/**
 * Base class for building MusicXML documents.
 *
 * Provides helper methods for:
 * - Duration conversion
 * - XML document creation
 * - MusicXML model construction (pitch, key, time, instruments, etc.)
 * - Metadata (identification, encoding)
 *
 * This class is intended to be extended by concrete converters
 * such as MIDI-to-MusicXML or other formats.
 */
abstract class MusicXMLBase
{
    const XML_VERSION = "1.0";
    const XML_ENCODING = "UTF-8";
    const DOCUMENT_ID = "score-partwise";
    const PUBLIC_ID = "-//Recordare//DTD MusicXML 4.0 Partwise//EN";
    const SYSTEM_ID = "http://www.musicxml.org/dtds/partwise.dtd";
    const SCORE_PARTWISE = "score-partwise";
    const SOFTWARE_NAME = "Planetbiru";
    const ENCODING_DESCRIPTION = "This software is not ready for production yet";

    /**
     * Convert MIDI duration (ticks) to MusicXML duration (divisions).
     *
     * Uses integer-safe calculation to avoid floating point drift,
     * especially for notes spanning multiple measures.
     *
     * @param int $duration   Duration in MIDI ticks
     * @param int $divisions  Divisions per quarter note (MusicXML)
     * @param int $timebase   MIDI ticks per quarter note
     * @return int            Duration in MusicXML divisions
     */
    public function fixDuration($duration, $divisions, $timebase)
    {
        return (int) round($duration * $divisions / $timebase);
    }

    /**
     * Calculate duration (alternative method)
     *
     * @param int $duration0  Durasi dasar (biasanya dalam beat/quarter)
     * @param int $divisions  Nilai divisions MusicXML
     * @param int $timebase   Resolusi tick MIDI
     * @return float|int      Durasi hasil perhitungan (dibatasi maksimal)
     */
    public function calculateDuration($duration0, $divisions, $timebase)
    {
        $duration = $divisions * $duration0 * $timebase / 4;
        if ($duration > $divisions * 16) {
            $duration = $divisions * 16;
        }
        return $duration;
    }

    /**
     * Get default notation (staccato)
     *
     * @return Notations  Objek notasi default dengan articulations (staccato)
     */
    public function getNotation()
    {
        $notations = new Notations();
        $articulation = new Articulations();
        $articulation->staccato = [new Staccato()];
        $notations->articulations = $articulation;
        return $notations;
    }

    /**
     * Initialize array jika null
     *
     * @param array|null $initialValue Nilai awal array (bisa null)
     * @return array                  Array kosong jika null, atau nilai asli
     */
    public function initializeArray($initialValue)
    {
        return isset($initialValue) ? $initialValue : [];
    }

    /**
     * Get time signature dalam format MusicXML
     *
     * @param TimeSignature $timeSignature Objek time signature (beats & beat-type)
     * @return Time                        Objek Time untuk MusicXML
     */
    public function getTime($timeSignature)
    {
        $time = new Time();
        $time->beats = [new Beats($timeSignature->getBeats())];
        $time->beatType = [new BeatType($timeSignature->getBeatType())];
        return $time;
    }

    /**
     * Get key signature
     *
     * @param int $fifths  Jumlah sharps/flats (misalnya: 0 = C, 1 = G, -1 = F)
     * @param int $mode    Mode tangga nada (0 = major, 1 = minor)
     * @return Key         Objek Key MusicXML
     */
    public function getKey($fifths, $mode)
    {
        $key = new Key();
        $key->fifths = $fifths;
        $key->mode = $mode;
        return $key;
    }

    /**
     * Get MIDI device
     *
     * @param int $midiId  ID perangkat MIDI
     * @param int $port    Port MIDI
     * @return MidiDevice  Objek MidiDevice
     */
    protected function getMidiDevice($midiId, $port)
    {
        $midiDevice = new MidiDevice();
        $midiDevice->id = $midiId;
        $midiDevice->port = $port;
        return $midiDevice;
    }

    /**
     * Get score instrument (informasi instrumen)
     *
     * @param string $instrumentId    ID unik instrumen
     * @param string $instrumentName  Nama instrumen (misalnya Piano)
     * @param string $instrumentSound Nama sound (MusicXML sound id)
     * @return ScoreInstrument        Objek ScoreInstrument
     */
    protected function getScoreInstrument($instrumentId, $instrumentName, $instrumentSound)
    {
        $scoreInstrument = new ScoreInstrument();
        $scoreInstrument->id = $instrumentId;
        $scoreInstrument->instrumentName = new InstrumentName($instrumentName);
        $scoreInstrument->instrumentSound = new InstrumentSound($instrumentSound);
        return $scoreInstrument;
    }

    /**
     * Get MIDI instrument
     *
     * @param int $midiChannel    Channel MIDI (0–15)
     * @param string $instrumentId ID instrumen
     * @param int $midiProgramId  Program MIDI (1–128)
     * @param float $volume       Volume (0–100)
     * @param float $pan          Pan (-90 sampai 90)
     * @return MidiInstrument     Objek MidiInstrument
     */
    protected function getMidiInstrument($midiChannel, $instrumentId, $midiProgramId, $volume = 100, $pan = 0)
    {
        $midiInstrument = new MidiInstrument();
        $midiInstrument->id = $instrumentId;
        $midiInstrument->midiChannel = new MidiChannel($midiChannel);
        $midiInstrument->midiProgram = new MidiProgram($midiProgramId);

        if ($volume > 100) {
            $volume = 100;
        }

        $midiInstrument->volume = new Volume($volume);
        $midiInstrument->pan = new Pan($pan);
        return $midiInstrument;
    }

    /**
     * Get score part
     *
     * @param string $partId            ID part (misal: P1)
     * @param string $partName          Nama part
     * @param string $partAbbreviation  Singkatan part
     * @param ScoreInstrument $scoreInstrument  Informasi instrumen
     * @param MidiInstrument $midiInstrument    Informasi MIDI
     * @param MidiDevice $midiDevice            Perangkat MIDI
     * @return ScorePart                Objek ScorePart lengkap
     */
    public function getScorePart($partId, $partName, $partAbbreviation, $scoreInstrument, $midiInstrument, $midiDevice)
    {
        $scorePart = new ScorePart();
        $scorePart->id = $partId;
        $scorePart->partName = new PartName($partName);
        $scorePart->partAbbreviation = new PartAbbreviation($partAbbreviation);
        $scorePart->scoreInstrument = [$scoreInstrument];
        $scorePart->midiInstrument = [$midiInstrument];
        $scorePart->midiDevice = [$midiDevice];
        return $scorePart;
    }

    /**
     * Create DOMDocument untuk MusicXML
     *
     * @return DOMDocument  Dokumen XML siap pakai (dengan DOCTYPE MusicXML)
     */
    public function getDOMDocument()
    {
        $domdoc = new DOMDocument();
        $domdoc->xmlVersion = self::XML_VERSION;
        $domdoc->encoding = self::XML_ENCODING;

        $implementation = new DOMImplementation();
        $domdoc->appendChild(
            $implementation->createDocumentType(
                self::DOCUMENT_ID,
                self::PUBLIC_ID,
                self::SYSTEM_ID
            )
        );

        $domdoc->preserveWhiteSpace = false;
        $domdoc->formatOutput = true;

        return $domdoc;
    }

    /**
     * Convert MIDI note number to MusicXML Pitch object.
     *
     * @param int $note MIDI note number (0–127)
     * @return Pitch
     */
    protected function getPitch($note)
    {
        $pitchStr = MusicXMLInstrument::NOTE_LIST[$note];

        $pitch = new Pitch();

        $step = new Step();
        $step->textContent = preg_replace("/[^A-G]/", "", $pitchStr);
        $pitch->step = $step;

        $octaveStr = preg_replace("/[^\-\d]/", "", $pitchStr);
        if (empty($octaveStr)) {
            $octaveStr = "0";
        }

        $pitch->octave = new Octave((int) $octaveStr);

        if (strpos($pitchStr, 's') !== false) {
            $alter = new Alter();
            $alter->textContent = 1;
            $pitch->alter = $alter;
        }

        return $pitch;
    }

    /**
     * Get identification metadata MusicXML
     *
     * @param string $copyright  Teks hak cipta
     * @return Identification    Objek Identification lengkap
     */
    public function getIdentification($copyright = "")
    {
        $identification = new Identification();

        $rights = new Rights();
        $rights->textContent = $copyright;
        $rights->type = 'music';

        $identification->rights = [$rights];

        $encoding = new Encoding();
        $encoding->encodingDate = [new EncodingDate(new DateTime())];
        $encoding->software = [new Software(self::SOFTWARE_NAME)];
        $encoding->encoder = [new Encoder('music')];
        $encoding->encodingDescription = [new EncodingDescription(self::ENCODING_DESCRIPTION)];

        $encoding->supports = [
            new Supports(['element' => 'accidental', 'type' => 'yes']),
            new Supports(['element' => 'beam', 'type' => 'yes']),
            new Supports(['element' => 'print', 'attribute' => 'new-page', 'type' => 'no']),
            new Supports(['element' => 'print', 'attribute' => 'new-system', 'type' => 'no']),
            new Supports(['element' => 'stem', 'type' => 'yes']),
        ];

        $identification->encoding = $encoding;

        return $identification;
    }

    /**
     * Get instrument sound (auto detect)
     *
     * @param int $channelId       Channel MIDI
     * @param int $programId       Program MIDI
     * @param string $instrumentName Nama instrumen
     * @return string|null         Nama sound MusicXML jika ditemukan
     */
    public function getIsntrumentSound($channelId, $programId, $instrumentName)
    {
        $array = explode(" ", strtolower($instrumentName));
        return $this->match1($array, $channelId, $programId, $instrumentName);
    }

    /**
     * Match nama instrumen terhadap daftar referensi
     *
     * @param array $explodedName   Nama instrumen yang sudah di-split
     * @param int $channelId        Channel MIDI
     * @param int $programId        Program MIDI
     * @param string $instrumentName Nama asli instrumen
     * @return string|null          Hasil match terbaik atau null
     */
    protected function match1($explodedName, $channelId, $programId, $instrumentName)
    {
        $found = [];

        foreach ($explodedName as $search) {
            foreach (MusicXMLInstrument::INSTRUMENT_LIST as $index => $chk) {
                $chkArr = explode('.', $chk[0]);

                if (in_array($search, $chkArr)) {
                    if (!isset($found[$chk[0]])) {
                        $found[$chk[0]] = 1;
                    } else {
                        $found[$chk[0]]++;
                    }
                }
            }
        }

        if (!empty($found)) {
            arsort($found);
            return array_keys($found)[0];
        }

        return null;
    }

    /**
     * Get pitch bend
     *
     * @param int $value     Nilai pitch bend (0–16383, default tengah 8192)
     * @param bool $preBend  Apakah pre-bend (opsional)
     * @param bool $release  Apakah release bend (opsional)
     * @return Bend          Objek Bend MusicXML
     */
    protected function getBend($value, $preBend = false, $release = false)
    {
        $bend = new Bend();
        $bend->bendAlter = round(($value - 8192) * 2 / 16383, 4);

        if ($preBend) {
            $bend->preBend = new PreBend();
        }

        if ($release) {
            $bend->release = new Release();
        }

        return $bend;
    }
}