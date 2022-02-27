<?php
namespace src\responses;

/**
 * The HTML response class which sets HTML headers
 *
 * @author Pervaiz Ahmad w18014333
 */
class HTMLResponse extends Response {
    // TODO: fix this -> check whether you need to add these for HTML Response
    private $message;
    private $statusCode;

    /**
     * Sets the appropriate HTML headers
     */
    protected function headers() {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: text/html; charset=UTF-8");
    }

    /**
     * The status message to be displayed in the JSON data
     *
     * @param string $message The status message
     */
    public function setMessage($message) {
        $this->message = $message;
    }

    /**
     * Sets the status code to be displayed in the JSON data
     *
     * @param int $code The status code
     */
    public function setStatusCode($code) {
        $this->statusCode = $code;
    }
}
