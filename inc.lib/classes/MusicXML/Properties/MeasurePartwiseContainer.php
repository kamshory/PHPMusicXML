<?php

namespace MusicXML\Properties;

use MusicXML\Model\MeasurePartwise;

class MeasurePartwiseContainer
{
    /**
     * MeasurePartwise
     *
     * @var MeasurePartwise
     */
    private $measurePartwise;

    /**
     * Note message
     *
     * @var array
     */
    private $noteMessages;

    /**
     * Constructor
     *
     * @param MeasurePartwise $measurePartwise
     * @param array $noteMessages
     */
    public function __construct($measurePartwise, $noteMessages)
    {
        $this->measurePartwise = $measurePartwise;
        $this->noteMessages = $noteMessages;
    }

    /**
     * Get measurePartwise
     *
     * @return  MeasurePartwise
     */ 
    public function getMeasurePartwise()
    {
        return $this->measurePartwise;
    }

    /**
     * Get note message
     *
     * @return  array
     */ 
    public function getNoteMessages()
    {
        return $this->noteMessages;
    }
}