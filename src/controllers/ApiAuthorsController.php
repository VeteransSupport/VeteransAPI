<?php
namespace src\controllers;

use src\gateways\AuthorGateway;
use src\responses\JSONResponse;

/**
 * Defines the "api/authors" endpoints and returns the resultant data.
 *
 * @author Pervaiz Ahmad w18014333
 */
class ApiAuthorsController extends Controller {

    /**
     * Sets the gateway as AuthorGateway()
     */
    protected function setGateway() {
        $this->gateway = new AuthorGateway();
    }

    /**
     * Analysis the request to point to an API
     * endpoint and then returns the resultant data.
     *
     * @return string The results of the API
     *                endpoint called
     */
    protected function processRequest() {
        $id = $this->getRequest()->getParameter("id");
        $firstName = $this->getRequest()->getParameter("first_name");
        $middleName = $this->getRequest()->getParameter("middle_name");
        $lastName = $this->getRequest()->getParameter("last_name");
        $paper_id = $this->getRequest()->getParameter("paper_id");

        if ($this->getRequest()->getRequestMethod() === "GET") {
            if (!is_null($id)) {
                $this->gateway->findById($id);
            } else if(!is_null($firstName) && !is_null($lastName)) {
                $this->gateway->findByFirstLastName($firstName, $lastName);
            } else if(!is_null($firstName)) {
                $this->gateway->findInFirstName($firstName);
            } else if(!is_null($middleName)) {
                $this->gateway->findInMiddleName($middleName);
            } else if(!is_null($lastName)) {
                $this->gateway->findInLastName($lastName);
            } else if(!is_null($paper_id)) {
                $this->gateway->findByPaperId($paper_id);
            } else {
                $this->gateway->findAll();
            }
        } else if ($this->getResponse() instanceof JSONResponse) {
            $this->getResponse()->setMessage("method not allowed");
            $this->getResponse()->setStatusCode(405);
        }

        return $this->gateway->getResult();
    }
}
