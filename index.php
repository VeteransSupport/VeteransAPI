<?php
/**
 * The router which points to different controllers
 * based on the URL request. Outputs both human-readable
 * and machine-readable (json) data is the url request
 * begins with (api/) after the base path.
 * 
 * @author Pervaiz Ahmad w18014333
 */

namespace index;

use src\controllers\ApiAuthenticateController;
use src\controllers\ApiBaseController;
use src\controllers\DocumentationController;
use src\controllers\HTMLErrorController;
use src\controllers\HomeController;
use src\controllers\JSONErrorController;
use src\request\Request;
use src\responses\HTMLResponse;
use src\responses\JSONResponse;

include_once "config/Config.php";

$request = new Request();

// Setting response
if (substr($request->getPath(),0,3) === "api") {
    $response = new JSONResponse();
} else {
    set_exception_handler("HTMLExceptionHandler");
    $response = new HTMLResponse();
}

switch ($request->getPath()) {
    case '':
    case 'home':
    case 'index.php':
        new HomeController($request, $response);
        break;
    case 'documentation':
        new DocumentationController($request, $response);
        break;
    case 'api':
        new ApiBaseController($request, $response);
        break;
    case 'api/authenticate':
        new ApiAuthenticateController($request, $response);
        break;
    default:
        if ($response instanceof HTMLResponse) {
            new HTMLErrorController($request, $response);
        } else if ($response instanceof JSONResponse) {
            $response->setMessage("not found");
            $response->setStatusCode(404);
            new JSONErrorController($request, $response);
        }
        break;
}

echo $response->getData();
