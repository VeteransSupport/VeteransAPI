<?php
namespace src\request;

/**
 * Retrieves the requested path from the URL and
 * removes from it the base path to get request
 *
 * @author Pervaiz Ahmad w18014333
 */
class Request {

    private $basePath = BASEPATH;
    private $path;
    private $requestMethod;

    /**
     * Stores the request from the URL and removes from it the base path.
     * Stores the request method.
     */
    public function __construct() {
        $this->path = parse_url($_SERVER["REQUEST_URI"])['path'];
        if ($this->basePath !== "/") {
            $this->path = strtolower(str_replace($this->basePath, "", $this->path));
        }
        $this->path = strtolower(trim($this->path,"/"));
        $this->requestMethod = $_SERVER["REQUEST_METHOD"];
    }

    /**
     * Returns the requested path.
     *
     * @return string The requested path
     */
    public function getPath() {
        return $this->path;
    }

    /**
     * Returns the request method
     *
     * @return string The request method
     */
    public function getRequestMethod() {
        return $this->requestMethod;
    }

    /**
     * This method will get and sanitise the given parameter. This approach
     * will return null if the parameter does not exist or false if the filter
     * is triggered.
     *
     * @param string $param The parameter to check for
     * @return string       The value of the parameter
     */
    public function getParameter($param) {
        if ($this->getRequestMethod() === "GET") {
            $param = filter_input(INPUT_GET, $param, FILTER_SANITIZE_SPECIAL_CHARS);
        }
        if ($this->getRequestMethod() === "POST") {
            $param = filter_input(INPUT_POST, $param, FILTER_SANITIZE_SPECIAL_CHARS);
        }
        return $param;
    }
}
