<?php

/**
 * Sets the exception handler for JSON response pages
 *
 * @author              Pervaiz Ahmad w18014333
 * @param Exception $e  The generated exception
 */
function JSONExceptionHandler($e) {
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    $output['error'] = "Internal server error! (Status 500)";
    http_response_code(500);

    if (DEVELOPMENT_MODE) {
        $output['Message'] = $e->getMessage();
        $output['File'] = $e->getFile();
        $output['Line'] = $e->getLine();
    }

    echo json_encode($output);
}
