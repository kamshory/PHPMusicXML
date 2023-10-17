<?php

namespace MusicXML\Properties;

use MusicXML\Model\Beam;

class BeamNote
{
    const TYPE_BACKWARD_HOOK = "backward hook";
    const TYPE_BEGIN = "begin";
    const TYPE_CONTINUE = "continue";
    const TYPE_END = "end";
    const TYPE_FORWARD_HOOK = "forward hook";
    /**
     * Index of element
     *
     * @var integer
     */
    public $index;
    /**
     * Beam
     *
     * @var Beam
     */
    public $beam;
    
    /**
     * Constructor
     *
     * @param integer $number
     * @param integer $beamIndex
     * @param integer $elementIndex
     */
    public function __construct($number, $beamIndex, $elementIndex)
    {
        $this->beam = new Beam($beamIndex == 0 ? self::TYPE_BEGIN : self::TYPE_CONTINUE);
        $this->beam->number = $number;
        $this->index = $elementIndex;
    }
    
    /**
     * Close beams
     *
     * @param self[] $beamNotes
     * @return self[]
     */
    public static function closeBeams($beamNotes)
    {
        $numbers = 0;
        foreach($beamNotes as $beamNote)
        {
            if($numbers < $beamNote->beam->number)
            {
                $numbers = $beamNote->beam->number;
            }
        }
        $length = count($beamNotes);
        for($number = $numbers - 1; $number >= 0; $number--)
        {
            for($i = $length -1; $i >= 0; $i--)
            {
                if(isset($beamNotes[$number]) && $beamNotes[$number]->index == $number)
                {
                    $beamNotes[$number]->beam->textContent = self::TYPE_END;
                    break;
                }
            }
        }
        return $beamNotes;
    }
}