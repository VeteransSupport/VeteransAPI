<?php

namespace src\controllers;

use src\Firebase\JWT\JWT;
use src\Firebase\JWT\Key;
use src\gateways\CharityLeadGateway;
use src\responses\JSONResponse;

class ApiCharityLeadController extends Controller {

    protected function setGateway() {
        $this->gateway = new CharityLeadGateway();
    }

    protected function processRequest() {
        $token = $this->getRequest()->getParameter("token");
        $id = $this->getRequest()->getParameter("id");
//        $charityId = $this->getRequest()->getParameter("charity_id");

        if ($this->getRequest()->getRequestMethod() === "GET") {
            if (!is_null($token)) {
                $key = SECRET_KEY;
                $decoded = JWT::decode($token, new Key($key, 'HS256'));
                $user_id = $decoded->user_id;

                $this->gateway->findTypeAndCharityById($user_id);
                if (count($this->gateway->getResult()) == 1) {
                    $type_id = $this->gateway->getResult()[0]['type_id'];
                    $currentCharityId = $this->gateway->getResult()[0]['charity_id'];

                    if ($type_id === '4') {
                        if(!is_null($id)){
                            $this->gateway->findCharityOfSupportUserById($currentCharityId, $id);
                        } else {
                            $this->gateway->findCharityAdminAndVeteransByCharityId($currentCharityId);
                            return $this->gateway->getResult();
                        }
                    } else {
                        $this->getResponse()->setMessage("Unauthorized");
                        $this->getResponse()->setStatusCode(401);
                    }
                }
            } else {
                $this->gateway->findCharityLeadByTypeID();
            }
        } else if ($this->getResponse() instanceof JSONResponse) {
            $this->getResponse()->setMessage("method not allowed");
            $this->getResponse()->setStatusCode(405);
        }

        return $this->gateway->getResult();
    }
}