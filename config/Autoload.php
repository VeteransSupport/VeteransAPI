<?php
/**
 * Automatically includes required classes. Uses namespaces to allow for
 * more robust loading of dependencies and avoid situations where two
 * classes may have the same names.
 *
 * @author                  Pervaiz Ahmad w18014333
 * @param string $className The name of the class being accessed
 * @throws exception        File not found
 */
function autoload($className) {
    $filename = str_replace('\\', DIRECTORY_SEPARATOR, $className. '.php');
    if (is_readable($filename)) {
        include_once $filename;
    } else {
        throw new exception("File not found: " . $className . " (" . $filename . ")");
    }
}
