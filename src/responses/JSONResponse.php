<?php
namespace src\responses;

/**
 * The JSON response class which sets JSON
 * headers and returns the JSON representation
 * of the data.
 *
 * @author Pervaiz Ahmad w18014333
 */
class JSONResponse extends Response {
    private $message;
    private $statusCode;

    /**
     * Sets the JSON headers.
     * Overrides parent headers() method.
     */
    protected function headers() {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
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

    /**
     * Sets status message and code and returns
     * the data in JSON format
     *
     * @return false|string The JSON data
     */
    public function getData() {
        if (is_null($this->message)) {
            if (count($this->data) === 0) {
                $this->message = "no content";
                $this->setStatusCode(204);
            } else {
                $this->setMessage("ok");
                $this->setStatusCode(200);
            }
        }

        http_response_code($this->statusCode);

        $response['message'] = $this->message;
        $response['count'] = count($this->data);
        $response['results'] = $this->data;
        return json_encode($response);
    }
}
