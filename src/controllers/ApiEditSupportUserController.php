<?php

namespace src\controllers;

use src\Firebase\JWT\JWT;
use src\Firebase\JWT\Key;
use src\gateways\SupportUsersGateway;
use src\responses\JSONResponse;

class ApiEditSupportUserController extends Controller {

    protected function setGateway() {
        $this->gateway = new SupportUsersGateway();
    }

    protected function processRequest() {
        $token = $this->getRequest()->getParameter("token");
        $request = $this->getRequest()->getParameter("request");
        $id = $this->getRequest()->getParameter("id");
        $email = $this->getRequest()->getParameter("email");
        $password = $this->getRequest()->getParameter("password");

        if ($this->getRequest()->getRequestMethod() === "POST") {
            if (!is_null($token)) {
                $key = SECRET_KEY;
                $decoded = JWT::decode($token, new Key($key, 'HS256'));
                $user_id = $decoded->user_id;

                $this->gateway->findTypeAndCharityById($user_id);
                if (count($this->gateway->getResult()) == 1) {
                    $type_id = $this->gateway->getResult()[0]['type_id'];
                    $currentCharityID = $this->gateway->getResult()[0]['charity_id'];

                    if ($type_id === '3' || $type_id === '2' || $type_id === '1') {
                        if ($request === 'add' && !is_null($email) &&!is_null($password)) {
                            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                            $this->gateway->addCharitySupport($email, $hashed_password, "4", $currentCharityID);
                        } else if ($request === 'delete' && !is_null($id)) {
                            $this->gateway->deleteUserById($id);
                        } else {
                            $this->gateway->setResult('');
                            $this->getResponse()->setMessage("Not Acceptable");
                            $this->getResponse()->setStatusCode(406);
                        }
                    } else if ($type_id === '4') {
                        if ($request === 'edit' && !is_null($id) && !is_null($email) && !is_null($password)) {
                            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                            $this->gateway->editSupportUserById($id, $email, $hashed_password, $type_id, $currentCharityID);
                        }
                    } else {
                        $this->gateway->setResult(''); // newly added
                        $this->getResponse()->setMessage("Unauthorized");
                        $this->getResponse()->setStatusCode(401);
                    }
                } else {
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