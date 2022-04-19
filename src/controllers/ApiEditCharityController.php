<?php

namespace src\controllers;

use src\Firebase\JWT\JWT;
use src\Firebase\JWT\Key;
use src\gateways\CharitiesGateway;

class ApiEditCharityController extends Controller {

    protected function setGateway() {
        $this->gateway = new CharitiesGateway();
    }

    protected function processRequest() {
        $token = $this->getRequest()->getParameter("token");
        $request = $this->getRequest()->getParameter("request");
        $id = $this->getRequest()->getParameter("id");
        $title = $this->getRequest()->getParameter("title");
        $description = $this->getRequest()->getParameter("description");
        $image = $this->getRequest()->getParameter("image");

        if ($this->getRequest()->getRequestMethod() === "POST") {
            if (!is_null($token)) {
                if (!is_null($request)){
                    $key = SECRET_KEY;
                    $decoded = JWT::decode($token, new Key($key, 'HS256'));
                    $user_id = $decoded->user_id;

                    $this->gateway->findTypeById($user_id);
                    if (count($this->gateway->getResult()) == 1) {
                        $type_id = $this->gateway->getResult()[0]['type_id'];

                        if ($type_id === '1' || $type_id === '2' || $type_id == '3') {
                            if ($request === 'edit' && !is_null($id) && !is_null($title) &&!is_null($description)) {
                                $imageVal = null;
                                if ($image !== '' ) {
                                    $imageVal = $image;
                                }
                                $this->gateway->editCharityById($id, $title, $description, $imageVal);
                            } else if ($request === 'create' && !is_null($title) &&!is_null($description)) {
                                $imageVal = null;
                                if ($image !== '' ) {
                                    $imageVal = $image;
                                }
                                $this->gateway->createCharity($title, $description, $imageVal);
                            } else if ($request === 'delete' && !is_null($id)) {
                                $this->gateway->deleteCharityById($id);
                            } else {
                                $this->gateway->setResult('');
                                $this->getResponse()->setMessage("Not Acceptable");
                                $this->getResponse()->setStatusCode(406);
                            }
                        } else {
                            $this->gateway->setResult('');
                            $this->getResponse()->setMessage("Unauthorized");
                            $this->getResponse()->setStatusCode(401);
                        }
                        return $this->gateway->getResult();
                    }
                    $this->getResponse()->setMessage("Unauthorized");
                    $this->getResponse()->setStatusCode(401);
                } else {
                    $this->getResponse()->setMessage("Not Acceptable");
                    $this->getResponse()->setStatusCode(406);
                }
            } else {
                $this->getResponse()->setMessage("Unauthorized");
                $this->getResponse()->setStatusCode(401);
            }
        } else {
            $this->getResponse()->setMessage("Method not allowed");
            $this->getResponse()->setStatusCode(405);
        }
        return $this->gateway->getResult();
    }
}
