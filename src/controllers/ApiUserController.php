<?php

namespace src\controllers;

use src\Firebase\JWT\JWT;
use src\Firebase\JWT\Key;
use src\gateways\UserGateway;
use src\responses\JSONResponse;

class ApiUserController extends Controller {

    protected function setGateway() {
        $this->gateway = new UserGateway();
    }

    protected function processRequest() {
        $token = $this->getRequest()->getParameter("token");
        $request = $this->getRequest()->getParameter("request");

        if ($this->getRequest()->getRequestMethod() === "POST") {
            if (!is_null($token)) {
                $key = SECRET_KEY;
                $decoded = JWT::decode($token, new Key($key, 'HS256'));
                $user_id = $decoded->user_id;
                $this->gateway->findTypeAndCharityById($user_id);
                if ($request === 'registry' && count($this->gateway->getResult()) == 1) {
                    $type_id = $this->gateway->getResult()[0]['type_id'];
                    if ($type_id === '1' || $type_id === '2' || $type_id === '3' || $type_id === '4') {
                        if ($type_id === '2') {
                            $type_id = '3';
                        }
                        $this->gateway->findUserRegistry($type_id);
                    } else {
                        $this->getResponse()->setMessage("Unauthorized");
                        $this->getResponse()->setStatusCode(401);
                    }
                } else if ($request === 'registry') {
                    $this->getResponse()->setMessage("Unauthorized");
                    $this->getResponse()->setStatusCode(401);
                }
            } else {
                $this->getResponse()->setMessage("Unauthorized");
                $this->getResponse()->setStatusCode(401);
            }
        } else if ($this->getResponse() instanceof JSONResponse) {
            $this->getResponse()->setMessage("method not allowed");
            $this->getResponse()->setStatusCode(405);
        }

        return $this->gateway->getResult();
    }
}
