<?php
namespace src\controllers;

/**
 * Defines the API base endpoints and returns the resultant data.
 *
 * @author Pervaiz Ahmad w18014333
 */
class ApiBaseController extends Controller {

    /**
     * Sets and returns the API basic info.
     *
     * @return array The JSON data for this endpoint
     */
    protected function processRequest() {
        $data['author']['name'] = "Pervaiz Ahmad";
        $data['author']['id'] = "w18014333";
        $data['message'] = "This is the base API endpoint for the informative application for DIS. It contains the author's name, ID and a link to the API documentation page";
        $data['documentation'] = "http://unn-w18014333.newnumyspace.co.uk/kf6012/coursework/part1/documentation";

        return $data;
    }
}
