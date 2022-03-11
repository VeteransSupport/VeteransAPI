<?php
namespace src\controllers;

use src\gateways\PaperGateway;
use src\responses\JSONResponse;

/**
 * Defines the "api/papers" endpoints and returns the resultant data
 *
 * @author Pervaiz Ahmad w18014333
 */
class ApiPapersController extends Controller {

    /**
     * Sets the gateway as PaperGateway()
     */
    protected function setGateway() {
        $this->gateway = new PaperGateway();
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
        $author_id = $this->getRequest()->getParameter("author_id");
        $award = $this->getRequest()->getParameter("award");
        $award_id = $this->getRequest()->getParameter("award_id");
        $title = $this->getRequest()->getParameter("title");
        $abstract = $this->getRequest()->getParameter("abstract");

        if ($this->getRequest()->getRequestMethod() === "GET") {
            if (!is_null($id)) {
                $this->gateway->findById($id);
            } else if(!is_null($author_id)) {
                $this->gateway->findByAuthorId($author_id);
            } else if(!is_null($award)) {
                $this->gateway->findByAward($award);
            } else if(!is_null($award_id)) {
                $this->gateway->findByAwardId($award_id);
            } else if(!is_null($title)) {
                $this->gateway->findInTitle($title);
            } else if(!is_null($abstract)) {
                $this->gateway->findInAbstract($abstract);
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
