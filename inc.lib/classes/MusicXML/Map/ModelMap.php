<?php

namespace MusicXML\Map;

class ModelMap
{
    const CLASS_MAP = array(
        "score-partwise"=>"\\MusicXML\\Model\\ScorePartWise"
    );

    const PROPERTY_MAP = array(
        "direction-type"=>"directionType",
        "encoding-date"=>"encodingDate",
        "software"=>"softwareList",
        "rights"=>"copyrights"
    );
}