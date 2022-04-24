<?php

namespace src\controllers;

use src\gateways\QuizGateway;
use src\responses\JSONResponse;

class ApiQuizController extends Controller {
    protected function setGateway() {
        $this->gateway = new QuizGateway();
    }

    protected function processRequest() {
        $id = $this->getRequest()->getParameter("id");

        if ($this->getRequest()->getRequestMethod() === "GET") {
            if (!is_null($id)) {
                $this->gateway->findById($id);
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