<?php
namespace src\controllers;

use src\gateways\UserGateway;
use src\responses\JSONResponse;

/**
 * Defines the "api/create_user" endpoints and returns the resultant data.
 *
 * @author Pervaiz Ahmad w18014333
 */
class ApiUpdateUserController extends Controller {

    /**
     * Sets the gateway as CreateUserGateway()
     */
    protected function setGateway() {
        $this->gateway = new UserGateway();
    }

    /**
     * Analysis the request to point to an API
     * endpoint and then returns the resultant data.
     *
     * @return string The results of the API
     *                endpoint called
     */
    protected function processRequest() {
        $username = $this->getRequest()->getParameter("username");
        $password = $this->getRequest()->getParameter("password");
        $request = $this->getRequest()->getParameter("request");

        if ($this->getRequest()->getRequestMethod() === "POST") {
            if ($request === "add") {
                if(!is_null($username) && !is_null($password)) {
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                    $this->gateway->addUser($username, $hashed_password);
                }
            } else if ($request === "remove") {
                if(!is_null($username) && !is_null($password)) {
                    $this->gateway->findPassword($username);
                    if (count($this->gateway->getResult()) == 1) {
                        $hashPassword = $this->gateway->getResult()[0]['password'];

                        // Verify if the passwords match
                        // If so, remove user
                        if (password_verify($password, $hashPassword)) {
                            $this->gateway->removeUser($username);
                        }
                    }
                }
                $this->gateway->setResult([]);
            }
        } else if ($this->getResponse() instanceof JSONResponse) {
            $this->getResponse()->setMessage("method not allowed");
            $this->getResponse()->setStatusCode(405);
        }

        return $this->gateway->getResult();
    }
}
