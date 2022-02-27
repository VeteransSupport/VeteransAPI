<?php
namespace src\controllers;

use src\gateways\Gateway;
use src\request\Request;
use src\responses\Response;

/**
 * The controller handles the request. It stores both the request
 * and response objects and sets the gateway which is being called.
 *
 * @author Pervaiz Ahmad w18014333
 */
abstract class Controller {

    private $request;
    private $response;
    protected $gateway;

    /**
     * Sets the gateway, request and response for the controller
     * and processes the request and returns the response
     *
     * @param Request $request
     * @param Response $response
     */
    public function __construct($request, $response) {
        $this->setGateway();
        $this->setRequest($request);
        $this->setResponse($response);

        $data = $this->processRequest();
        $this->getResponse()->setData($data);
    }

    /**
     * Sets the request in the controller
     *
     * @param Request $request The request
     */
    private function setRequest($request) {
        $this->request = $request;
    }

    /**
     * Gives the request set in the controller
     *
     * @return Request The request
     */
    protected function getRequest() {
        return $this->request;
    }

    /**
     * Sets the response in the controller
     *
     * @param Response $response The response
     */
    private function setResponse($response) {
        $this->response = $response;
    }

    /**
     * Gives the response set in the controller
     *
     * @return Response The response class
     */
    protected function getResponse() {
        return $this->response;
    }

    /**
     * Placeholder Method
     */
    protected function setGateway() {
    }

    /**
     * The gateway set in the controller
     *
     * @return Gateway The gateway
     */
    protected function getGateway() {
        return $this->gateway;
    }
}
