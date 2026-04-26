<?php
/**
 * Autoloader compatible with PHP 5.3+
 * Maps Namespaces to the 'classes' directory
 */
spl_autoload_register(function ($class) {
    // Remove leading backslash for consistent mapping
    $class = ltrim($class, '\\');
    
    // Base directory for classes
    $base_dir = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'classes' . DIRECTORY_SEPARATOR;

    // Convert namespace separators to directory separators and append .php
    $file = $base_dir . str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';

    if (file_exists($file)) {
        require_once $file;
    }
});
