<?php
namespace src\controllers;

/**
 * Defines the JSON not found error response and returns the JSON data.
 */
class JSONErrorController extends Controller {
    /**
     * Adds the error message and returns the JSON data
     *
     * @return array The JSON error response data
     */
    protected function processRequest() {
        $data['error_message'] = "The API endpoint being requested was not found.";

        return $data;
    }
}
