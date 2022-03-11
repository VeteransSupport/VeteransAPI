<?php
namespace src\responses;

/**
 * The HTML response class which sets HTML headers
 *
 * @author Pervaiz Ahmad w18014333
 */
class HTMLResponse extends Response {

    /**
     * Sets the appropriate HTML headers
     */
    protected function headers() {
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: text/html; charset=UTF-8");
    }
}
