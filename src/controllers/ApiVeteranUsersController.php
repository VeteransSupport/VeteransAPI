<?php

namespace src\controllers;

use src\Firebase\JWT\JWT;
use src\Firebase\JWT\Key;
use src\gateways\VeteranUsersGateway;
use src\responses\JSONResponse;

class ApiVeteranUsersController extends Controller {

    protected function setGateway() {
        $this->gateway = new VeteranUsersGateway();
    }

    protected function processRequest() {
        $token = $this->getRequest()->getParameter("token");

        if ($this->getRequest()->getRequestMethod() === "GET") {
            if (!is_null($token)) {
                $key = SECRET_KEY;
                $decoded = JWT::decode($token, new Key($key, 'HS256'));
                $user_id = $decoded->user_id;

                $this->gateway->findTypeAndCharityById($user_id);
                if (count($this->gateway->getResult()) == 1) {
                    $type_id = $this->gateway->getResult()[0]['type_id'];
                    $currentCharityID = $this->gateway->getResult()[0]['charity_id'];

                    if ($type_id === '3') {
                        $this->gateway->findVeteranUsersByTypeId($currentCharityID);
                    } else {
                        $this->getResponse()->setMessage("Unauthorized");
                        $this->getResponse()->setStatusCode(401);
                    }
                }
            } else {
                $this->gateway->findAllVeteranUsers();
            }
        } else if ($this->getResponse() instanceof JSONResponse) {
            $this->getResponse()->setMessage("method not allowed");
            $this->getResponse()->setStatusCode(405);
        }

        return $this->gateway->getResult();
    }
}