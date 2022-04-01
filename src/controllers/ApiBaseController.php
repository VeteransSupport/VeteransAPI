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
        $data['message'] = "This is the API for the Veterans App. It is currently in development with irrelevant endpoints which will be later removed. A link to the documentation page is provided however it is only lists the irrelevant endpoints which will be removed.";
        $data['documentation'] = "http://unn-w18014333.newnumyspace.co.uk/kf6012/coursework/part1/documentation";

        return $data;
    }
}
