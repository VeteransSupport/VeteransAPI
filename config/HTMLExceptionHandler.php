<?php

/**
 * Sets the exception handler for human-readable web pages
 *
 * @author              Pervaiz Ahmad w18014333
 * @param Exception $e  The generated exception
 */
function HTMLExceptionHandler($e) {
    echo "<p>internal server error! (Status 500)</p>";
    if (DEVELOPMENT_MODE) {
        echo "<p>";
        echo "Message: ".  $e->getMessage();
        echo "<br>File: ". $e->getFile();
        echo "<br>Line: ". $e->getLine();
        echo "</p>";
    }
}
