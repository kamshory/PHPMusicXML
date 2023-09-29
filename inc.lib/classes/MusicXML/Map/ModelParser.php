<?php

namespace MusicXML\Map;

class ModelParser
{
    
    
    /**
     * Parse model
     *
     * @param string $className
     * @return array
     */
    public static function parseModel($className, $object)
    {
        // parse here
        if(isset(ModelCache::$cache[$className]))
        {
            return ModelCache::$cache[$className];
        }
        
        
        
        return array();
    }
}