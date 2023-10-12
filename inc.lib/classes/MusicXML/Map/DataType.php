<?php

namespace MusicXML\Map;

/**
 * MusicXML data type
 * Reference: https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/
 */
class DataType
{
    const DATA_TYPE = array(
        "above-below" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/above-below/
        "accidental-value" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/accidental-value/
        "accordion-middle" => array("traditional_type" => "integer", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/accordion-middle/ base=positiveInteger
        "anyURI" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/xsd-anyURI/
        "arrow-direction" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/arrow-direction/
        "arrow-style" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/arrow-style/
        "backward-forward" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/backward-forward/
        "bar-style" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/bar-style/
        "beam-level" => array("traditional_type" => "integer", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/beam-level/ base=positiveInteger
        "beam-value" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/beam-value/
        "beater-value" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/beater-value/
        "bend-shape" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/bend-shape/
        "breath-mark-value" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/breath-mark-value/
        "caesura-value" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/caesura-value/
        "cancel-location" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/cancel-location/
        "circular-arrow" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/circular-arrow/
        "clef-sign" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/clef-sign/
        "color" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/color/
        "comma-separated-text" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/comma-separated-text/      
        "css-font-size" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/css-font-size/
        "date" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/xsd-date/
        "decimal" => array("traditional_type" => "float", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/xsd-decimal/
        "degree-symbol-value" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/degree-symbol-value/        
        "degree-type-value" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/degree-type-value/
        "distance-type" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/distance-type/
        "divisions" => array("traditional_type" => "float", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/divisions/ base=decimal
        "effect-value" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/effect-value/
        "enclosure-shape" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/enclosure-shape/
        "ending-number" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/ending-number/
        "fan" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/fan/
        "fermata-shape" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/fermata-shape/
        "fifths" => array("traditional_type" => "integer", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/fifths/ base=integer
        "font-family" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/font-family/
        "font-size" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/font-size/
        "font-style" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/font-style/
        "font-weight" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/font-weight/
        "glass-value" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/glass-value/
        "glyph-type" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/glyph-type/
        "group-barline-value" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/group-barline-value/        
        "group-symbol-value" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/group-symbol-value/
        "handbell-value" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/handbell-value/
        "harmon-closed-location" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/harmon-closed-location/  
        "harmon-closed-value" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/harmon-closed-value/        
        "harmony-arrangement" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/harmony-arrangement/        
        "harmony-type" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/harmony-type/
        "hole-closed-location" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/hole-closed-location/      
        "hole-closed-value" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/hole-closed-value/
        "ID" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/xsd-id/
        "IDREF" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/xsd-idref/
        "integer" => array("traditional_type" => "integer", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/xsd-integer/ integer
        "kind-value" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/kind-value/
        "left-center-right" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/left-center-right/
        "left-right" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/left-right/
        "line-end" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/line-end/
        "line-length" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/line-length/
        "line-shape" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/line-shape/
        "line-type" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/line-type/
        "line-width-type" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/line-width-type/
        "margin-type" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/margin-type/
        "measure-numbering-value" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/measure-numbering-value/        
        "measure-text"=>array("traditional_type"=>"string", "filter"=>"", "allowed_value"=>null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/measure-text/
        "membrane-value" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/membrane-value/
        "metal-value" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/metal-value/
        "midi-128" => array("traditional_type" => "integer", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/midi-128/
        "midi-16" => array("traditional_type" => "integer", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/midi-16/
        "midi-16384" => array("traditional_type" => "integer", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/midi-16384/
        "millimeters" => array("traditional_type" => "float", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/millimeters/
        "milliseconds" => array("traditional_type" => "integer", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/milliseconds/
        "mode" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/mode/
        "mute" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/mute/
        "NMTOKEN" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/xsd-nmtoken/
        "non-negative-decimal" => array("traditional_type" => "float", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/non-negative-decimal/       
        "nonNegativeInteger" => array("traditional_type" => "integer", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/xsd-nonNegativeInteger/
        "note-size-type" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/note-size-type/
        "note-type-value" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/note-type-value/
        "notehead-value" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/notehead-value/
        "number-level" => array("traditional_type" => "integer", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/number-level/ base=positiveInteger
        "number-of-lines" => array("traditional_type" => "integer", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/number-of-lines/ base=nonNegativeInteger (0, 3)
        "number-or-normal" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/number-or-normal/
        "numeral-mode" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/numeral-mode/
        "numeral-value" => array("traditional_type" => "integer", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/numeral-value/ base=positiveInteger (1, 7)
        "octave" => array("traditional_type" => "integer", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/octave/ base=integer (0, 9)
        "on-off" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/on-off/
        "over-under" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/over-under/
        "pedal-type" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/pedal-type/
        "percent" => array("traditional_type" => "float", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/percent/ base=decimal (0, 100)
        "pitched-value" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/pitched-value/
        "positive-divisions" => array("traditional_type" => "integer", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/positive-divisions/ base=divisions (0, infinite)
        "positive-integer-or-empty" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/positive-integer-or-empty/
        "positiveInteger" => array("traditional_type" => "integer", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/xsd-positiveInteger/ base=integer (0, infinite)
        "principal-voice-symbol" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/principal-voice-symbol/  
        "right-left-middle" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/right-left-middle/
        "rotation-degrees" => array("traditional_type" => "float", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/rotation-degrees/ base=decimal (-180, 180)
        "semi-pitched" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/semi-pitched/
        "semitones" => array("traditional_type" => "float", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/semitones/ base=decimal (-1, 1)     
        "show-frets" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/show-frets/
        "show-tuplet" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/show-tuplet/
        "smufl-accidental-glyph-name" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/smufl-accidental-glyph-name/
        "smufl-coda-glyph-name" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/smufl-coda-glyph-name/    
        "smufl-glyph-name" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/smufl-glyph-name/
        "smufl-lyrics-glyph-name" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/smufl-lyrics-glyph-name/        
        "smufl-pictogram-glyph-name"=>array("traditional_type"=>"string", "filter"=>"", "allowed_value"=>null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/smufl-pictogram-glyph-name/
        "smufl-segno-glyph-name" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/smufl-segno-glyph-name/  
        "smufl-wavy-line-glyph-name" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/smufl-wavy-line-glyph-name/
        "staff-divide-symbol" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/staff-divide-symbol/        
        "staff-line" => array("traditional_type" => "integer", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/staff-line/ base=positiveInteger
        "staff-line-position" => array("traditional_type" => "integer", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/staff-line-position/ base=integer       
        "staff-number" => array("traditional_type" => "integer", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/staff-number/ base=positiveInteger 
        "staff-type" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/staff-type/
        "start-note" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/start-note/
        "start-stop" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/start-stop/
        "start-stop-continue" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/start-stop-continue/        
        "start-stop-discontinue" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/start-stop-discontinue/  
        "start-stop-single" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/start-stop-single/
        "stem-value" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/stem-value/
        "step" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/step/
        "stick-location" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/stick-location/
        "stick-material" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/stick-material/
        "stick-type" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/stick-type/
        "string" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/xsd-string/
        "string-number" => array("traditional_type" => "integer", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/string-number/ base=positiveInteger
        "swing-type-value" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/swing-type-value/
        "syllabic" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/syllabic/
        "symbol-size" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/symbol-size/
        "sync-type" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/sync-type/
        "system-relation" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/system-relation/
        "system-relation-number" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/system-relation-number/  
        "tap-hand" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/tap-hand/
        "tenths" => array("traditional_type" => "float", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/tenths/
        "text-direction" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/text-direction/
        "tied-type" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/tied-type/
        "time-only" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/time-only/
        "time-relation" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/time-relation/
        "time-separator" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/time-separator/
        "time-symbol" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/time-symbol/
        "tip-direction" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/tip-direction/
        "token" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/xsd-token/
        "top-bottom" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/top-bottom/
        "tremolo-marks" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/tremolo-marks/
        "tremolo-type" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/tremolo-type/
        "trill-beats" => array("traditional_type" => "integer", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/trill-beats/ base=integer (2, infinite)
        "trill-step" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/trill-step/
        "two-note-turn" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/two-note-turn/
        "up-down" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/up-down/
        "up-down-stop-continue" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/up-down-stop-continue/    
        "upright-inverted" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/upright-inverted/
        "valign" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/valign/
        "valign-image" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/valign-image/
        "wedge-type" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/wedge-type/
        "winged" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/winged/
        "wood-value" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/wood-value/
        "xlink:actuate" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/xlink-actuate/
        "xlink:show" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/xlink-show/
        "xlink:type" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/xlink-type/
        "xml:lang" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/xml-lang/
        "xml:space" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/xml-space/
        "yes-no" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/yes-no/
        "yes-no-number" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/yes-no-number/
        "yyyy-mm-dd" => array("traditional_type" => "string", "filter" => null, "allowed_value" => null), // Reference https://www.w3.org/2021/06/musicxml40/musicxml-reference/data-types/yyyy-mm-dd/
    );
}