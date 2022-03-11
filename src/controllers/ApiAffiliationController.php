<?php
namespace src\controllers;

use src\gateways\AffiliationGateway;
use src\responses\JSONResponse;

/**
 * Defines the "api/authors" endpoints and returns the resultant data.
 *
 * @author Pervaiz Ahmad w18014333
 */
class ApiAffiliationController extends Controller {

    /**
     * Sets the gateway as AffiliationGateway()
     */
    protected function setGateway() {
        $this->gateway = new AffiliationGateway();
    }

    /**
     * Analysis the request to point to an API
     * endpoint and then returns the resultant data.
     *
     * @return string The results of the API
     *                endpoint called
     */
    protected function processRequest() {
        $paperId = $this->getRequest()->getParameter("paper_id");
        $authorId = $this->getRequest()->getParameter("author_id");
        $country = $this->getRequest()->getParameter("country");
        $state = $this->getRequest()->getParameter("state");
        $city = $this->getRequest()->getParameter("city");
        $institution = $this->getRequest()->getParameter("institution");
        $department = $this->getRequest()->getParameter("department");

        if ($this->getRequest()->getRequestMethod() === "GET") {
            if (!is_null($paperId) && !is_null($authorId)) {
                $this->gateway->findByPaperAndAuthorId($paperId, $authorId);
            } else if(!is_null($paperId)) {
                $this->gateway->findInPaperId($paperId);
            } else if(!is_null($authorId)) {
                $this->gateway->findInAuthorId($authorId);
            } else if(!is_null($country)) {
                $this->gateway->findInCountry($country);
            } else if(!is_null($state)) {
                $this->gateway->findInState($state);
            } else if(!is_null($city)) {
                $this->gateway->findInCity($city);
            } else if(!is_null($institution)) {
                $this->gateway->findInInstitution($institution);
            } else if(!is_null($department)) {
                $this->gateway->findInDepartment($department);
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
