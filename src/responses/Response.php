<?php
namespace src\responses;

/**
 * The response class sets the appropriate headers,
 * stores the data and returns it using getData().
 *
 * @author Pervaiz Ahmad w18014333
 */
abstract class Response {
    protected $data;

    /**
     * Sets the header
     */
    public function __construct() {
        $this->headers();
    }

    /**
     * Locally stores the data provided
     *
     * @param string $data  The returned data as a string
     */
    public function setData($data) {
        $this->data = $data;
    }

    /**
     * Returns the data as a string
     * which may be html or json
     *
     * @return string The stored data
     */
    public function getData() {
        return $this->data;
    }

    /**
     * Empty method. Child classes override this
     * method to set the appropriate headers
     */
    protected function headers() {
    }
}
