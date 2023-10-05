<?php

namespace MusicXML;

use DOMDocument;
use Midi\MidiMeasure;
use MusicXML\Map\ModelMap;
use MusicXML\Map\NodeType;
use MusicXML\Model\Attributes;
use MusicXML\Model\Clef;
use MusicXML\Model\Key;
use MusicXML\Model\Measure;
use MusicXML\Model\Part;
use MusicXML\Model\PartList;
use MusicXML\Model\ScorePartWise;
use MusicXML\Model\Time;
use MusicXML\Model\Transpose;
use MusicXML\Util\MXL;

/**
 * @version 1.0.0
 */
class MusicXML extends MusicXMLBase
{
    public function loadXml($path)
    {
        $domdoc = new DOMDocument();
        $domdoc->loadXML(file_get_contents($path));
        $nodes = $domdoc->childNodes;
        $object = null;
        foreach($nodes as $node)
        {
            if($node->nodeType == NodeType::ELEMENT && isset(ModelMap::CLASS_MAP[$node->tagName]))
            {
                $className = ModelMap::CLASS_MAP[$node->tagName];
                $object = new $className($node);
                break;
            }
        }
        echo $object;  
        
    }


    /**
     * Convert MIDI to MusicXML
     *
     * @param MidiMeasure $midi
     * @param string $version Version of MusicXML
     * @return string
     */
    public function midiToMusicXml($midi, $title, $version = "4.0", $format = MXL::XML)
    {
        $domdoc = $this->getDOMDocument();
        $midi2mxl = new MusicXMLFromMidi();
        $domdoc->appendChild($midi2mxl->convertMidiToMusicXML($midi, $title, $domdoc, $version));
        if($format == MXL::MXL)
        {
            $mxl = new MXL();
            return $mxl->xmlToMxl($title, $domdoc->saveXML());
        }
        else
        {
            return $domdoc->saveXML();
        }  
    }

    

    /**
     * Create Music XML manualy
     *
     * @param DOMDocument $domdoc
     * @param string $version
     * @return DOMDocument
     */
    public function getMusicXml($domdoc, $version = "4.0")
    {
        $scorePartWise = new ScorePartWise();
        $scorePartWise->version = $version;
        $scorePartWise->setIdentification($this->getIdentification());
        $scorePartWise->partList = new PartList();
        $scorePartWise->partList->partGroupList = array();

        // start add score part
        // this block will be iterated each channel
        $partId = "P1";
        $partName = "Cinta Pertama dan Terakhir";
        $partAbbreviation = "Pno.";

        $instrumentName = "Piano";
        $instrumentSound = "keyboard.piano";

        $midiChannel = 1;
        $midiProgramId = 1;
        $instrumentId = 'P1-I1';

        $volume = 78.7402;
        $pan = 0;

        $scoreInstrument = $this->getScoreInstrument($instrumentId, $instrumentName, $instrumentSound);
        $midiInstrument = $this->getMidiInstrument($midiChannel, $instrumentId, $midiProgramId, $volume, $pan);
        $midiDevice = $this->getMidiDevice($instrumentId, $midiChannel);

        $scorePartWise->partList->scorePartList[] = $this->getScorePart($partId, $partName, $partAbbreviation, $scoreInstrument, $midiInstrument, $midiDevice);
        // end add score part

        $scorePartWise->part = array();

        $part = new Part();
        $part->id = "P1";
        $part->measureList = array();

        $measure = new Measure();
        $measure->number = 1;


        $key = new Key();
        $key->fifths = 1;

        $time = new Time();
        $time->beats = 3;
        $time->beatType = 4;

        $clef = new Clef();
        $clef->sign = "F";
        $clef->line = 4;

        $transpose = new Transpose();
        $transpose->diatonic = 0;
        $transpose->chromatic = 0;
        $transpose->octaveChange = 0;

        $attributes = new Attributes();
        $attributes->divisions = 1;
        $attributes->staves = 1;
        $attributes->key = $key;
        $attributes->time = $time;
        $attributes->clef = $clef;
        $attributes->transpose = $transpose;

        $measure->attributes = $attributes;

        $part->measureList[] = $measure;

        $scorePartWise->part[] = $part;

        return $scorePartWise->toXml($domdoc, self::SCORE_PARTWISE);
    }

    

    
}
