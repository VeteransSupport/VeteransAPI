<?php
namespace src\controllers;

use src\Firebase\JWT\JWT;
use src\Firebase\JWT\Key;
use src\gateways\ReadingListGateway;

/**
 * Defines the "api/reading_list" endpoints and returns the resultant data.
 *
 * @author Pervaiz Ahmad w18014333
 */
class ApiReadingListController extends Controller {

    /**
     * Sets the gateway as ReadingListGateway()
     */
    protected function setGateway() {
        $this->gateway = new ReadingListGateway();
    }

    /**
     * Verifies the username and password using JWTs before
     * analysing the request to point to an API endpoint
     * and then returns the resultant data for ReadingList.
     *
     * @return string The result of the API
     */
    protected function processRequest() {
        $token = $this->getRequest()->getParameter("token");
        $add = $this->getRequest()->getParameter("add");
        $remove = $this->getRequest()->getParameter("remove");

        if ($this->getRequest()->getRequestMethod() === "POST") {
            if (!is_null($token)) {
                $key = SECRET_KEY;
                $decoded = JWT::decode($token, new Key($key, 'HS256'));
                $user_id = $decoded->user_id;

                if (!is_null($add)) {
                    $this->gateway->add($user_id, $add);
                } elseif (!is_null($remove)) {
                    $this->gateway->remove($user_id, $remove);
                } else {
                    $this->gateway->findAll($user_id);
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
