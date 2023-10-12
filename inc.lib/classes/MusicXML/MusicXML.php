<?php

namespace MusicXML;

use DOMDocument;
use MusicXML\Map\ModelMap;
use MusicXML\Map\NodeType;
use MusicXML\Model\Attributes;
use MusicXML\Model\Beats;
use MusicXML\Model\BeatType;
use MusicXML\Model\Chromatic;
use MusicXML\Model\Clef;
use MusicXML\Model\Diatonic;
use MusicXML\Model\Divisions;
use MusicXML\Model\Fifths;
use MusicXML\Model\Key;
use MusicXML\Model\Line;
use MusicXML\Model\MeasurePartwise;
use MusicXML\Model\OctaveChange;
use MusicXML\Model\PartList;
use MusicXML\Model\PartPartwise;
use MusicXML\Model\ScorePartwise;
use MusicXML\Model\Sign;
use MusicXML\Model\Staves;
use MusicXML\Model\Time;
use MusicXML\Model\Transpose;

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
            if($node->nodeType == NodeType::ELEMENT && isset(ModelMap::CLASS_MAP[$node->tagName])) //NOSONAR
            {
                $className = ModelMap::CLASS_MAP[$node->tagName]; //NOSONAR
                $object = new $className($node);
                break;
            }
        }
        echo $object;  
        
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
        $scorePartwise = new ScorePartwise();
        $scorePartwise->version = $version;
        $scorePartwise->setIdentification($this->getIdentification());
        $scorePartwise->partList = new PartList();
        $scorePartwise->partList->partGroup = array();

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

        $scorePartwise->partList->scorePart[] = $this->getScorePart($partId, $partName, $partAbbreviation, $scoreInstrument, $midiInstrument, $midiDevice);
        // end add score part

        $scorePartwise->part = array();

        $part = new PartPartwise();
        $part->id = "P1";
        $part->measure = array();

        $measure = new MeasurePartwise();
        $measure->number = 1;

        $key = new Key();
        $key->fifths = new Fifths(1);

        $time = new Time();
        $time->beats = new Beats(3);
        $time->beatType = new BeatType(4);

        $clef = new Clef();
        $clef->sign = new Sign("F");
        $clef->line = new Line(4);

        $transpose = new Transpose();
        $transpose->diatonic = new Diatonic(0);
        $transpose->chromatic = new Chromatic(0);
        $transpose->octaveChange = new OctaveChange(0);

        $attributes = new Attributes();
        $attributes->divisions = new Divisions(1);
        $attributes->staves = new Staves(1);
        $attributes->key = $key;
        $attributes->time = $time;
        $attributes->clef = $clef;
        $attributes->transpose = $transpose;

        $measure->attributes = $attributes;

        $part->measure[] = $measure;

        $scorePartwise->part[] = $part;

        return $scorePartwise->toXml($domdoc, self::SCORE_PARTWISE);
    }

    

    
}
