<?php

namespace MusicXML\Properties;

use MusicXML\Model\Duration;
use MusicXML\Model\Notations;
use MusicXML\Model\Note;
use MusicXML\Model\Tie;
use MusicXML\Model\Tied;
use MusicXML\Model\Type;
use MusicXML\MusicXMLUtil;

class TieStop
{
    /**
     * Target measure index
     *
     * @var integer
     */
    private $targetMeasureIndex = 0;

    /**
     * Origin measure index
     *
     * @var integer
     */
    private $originMeasureIndex = 0;

    /**
     * Note
     *
     * @var Note
     */
    private $note = null;

    /**
     * Tie range
     *
     * @var integer
     */
    private $tieRange = 0; 

    /**
     * Duration remaining
     *
     * @var integer
     */
    private $durationRemaining = 0;

    /**
     * Time remaining
     *
     * @var integer
     */
    private $timeRemaining = 0;

    /**
     * Constructor
     *
     * @param integer $targetMeasureIndex
     * @param integer $originMeasureIndex
     * @param Note $note
     * @param integer $tieRange
     * @param integer $remaining
     * @param integer $timeRemaining
     */
    public function __construct($targetMeasureIndex, $originMeasureIndex, $note, $tieRange, $durationRemaining, $timeRemaining, $divisions)
    {
        $this->targetMeasureIndex = $targetMeasureIndex;
        $this->originMeasureIndex = $originMeasureIndex;
        $newNote = new Note();
        $newNote->pitch = $note->pitch;
        $tie = new Tie();
        $tie->type = 'stop';
        $tied = new Tied();
        $tied->type = 'stop';
        $note->type = new Type(MusicXMLUtil::getNoteType($durationRemaining, $divisions));   

        $notations = new Notations();
        $notations->tied = $tied;

        $newNote->tie = $tie;
        $newNote->notations = $notations;
        $newNote->duration = new Duration($durationRemaining);
 
        
        $this->note = $newNote;
        $this->tieRange = $tieRange; 
        $this->durationRemaining = $durationRemaining;
        $this->timeRemaining = $timeRemaining;
    }

    /**
     * Get target measure index
     *
     * @return  integer
     */ 
    public function getTargetMeasureIndex()
    {
        return $this->targetMeasureIndex;
    }

    /**
     * Get origin measure index
     *
     * @return  integer
     */ 
    public function getOriginMeasureIndex()
    {
        return $this->originMeasureIndex;
    }

    /**
     * Get note
     *
     * @return  Note
     */ 
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Get tie range
     *
     * @return  integer
     */ 
    public function getTieRange()
    {
        return $this->tieRange;
    }

    /**
     * Get duration remaining
     *
     * @return  integer
     */ 
    public function getDurationRemaining()
    {
        return $this->durationRemaining;
    }

    /**
     * Get time remaining
     *
     * @return  integer
     */ 
    public function getTimeRemaining()
    {
        return $this->timeRemaining;
    }
}