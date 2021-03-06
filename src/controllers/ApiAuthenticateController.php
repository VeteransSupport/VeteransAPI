<?php
namespace src\controllers;

use src\Firebase\JWT\JWT;
use src\gateways\UserGateway;
use src\responses\JSONResponse;

/**
 * Defines the "api/authenticate" endpoints and returns the resultant data.
 *
 * @author Pervaiz Ahmad w18014333
 */
class ApiAuthenticateController extends Controller {

    /**
     * Sets the gateway as UserGateway()
     */
    protected function setGateway() {
        $this->gateway = new UserGateway();
    }

    /**
     * Verifies the email and password of a user in the user
     * table and sets the JWT with the user id and an expiration
     * date of 90 days from the time it was generated, as well as
     * the time it was generated.
     *
     * @return array The JSON data
     */
    protected function processRequest() {
        $data = [];
        $email = $this->getRequest()->getParameter("email");
        $password = $this->getRequest()->getParameter("password");

        if ($this->getRequest()->getRequestMethod() === "POST") {
            // Check if parameters are null
            // Return a 401 status otherwise
            if (!is_null($email) && !is_null($password)) {
                $this->gateway->findPassword($email);
                if (count($this->gateway->getResult()) == 1) {
                    $hashPassword = $this->getGateway()->getResult()[0]['password'];

                    // Verify if the passwords match
                    // If so, create a token
                    if (password_verify($password, $hashPassword)) {

                        // Setting token payload
                        $payload = array(
                            "user_id" => $this->getGateway()->getResult()[0]['id'],
                            "email" => $this->getGateway()->getResult()[0]['email'],
                            "iss" => "...", // TODO: add url here
                            "exp" => time() + 900, // TODO: Check session expiration with savannah
                            "iat" => time()
                        );

                        $jwt = JWT::encode($payload, SECRET_KEY, 'HS256');

                        $data = ['token' => $jwt];
                    }
                }
            }

            if (!array_key_exists('token',$data)) {
                $this->getResponse()->setMessage("Unauthorized");
                $this->getResponse()->setStatusCode(401);
            }
        } else if ($this->getResponse() instanceof JSONResponse) {
            $this->getResponse()->setMessage("method not allowed");
            $this->getResponse()->setStatusCode(405);
        }

        return $data;
    }
}
