<?php

/**
 * Formats the error message to throw when an error occurs.
 *
 * @author              Pervaiz Ahmad w18014333
 * @throws Exception    Error Detected
 */
function ErrorHandler($errno, $errstr, $errfile, $errline) {
    if (($errno != 2 && $errno != 8) || DEVELOPMENT_MODE) {
        throw new Exception("Error Detected: [$errno] $errstr file: $errfile line: $errline", 1);
    }
}
