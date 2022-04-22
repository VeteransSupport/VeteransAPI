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

use src\controllers\ApiAffiliationController;
use src\controllers\ApiAuthenticateController;
use src\controllers\ApiAuthorsController;
use src\controllers\ApiBaseController;
use src\controllers\ApiCharitiesController;
use src\controllers\ApiEditCharityController;
use src\controllers\ApiUpdateUserController;
use src\controllers\ApiSuppAppUsersController;
use src\controllers\ApiSupportUsersController;
use src\controllers\ApiEditSupportUserController;
use src\controllers\ApiVeteranUsersController;
use src\controllers\ApiCharityLeadController;
use src\controllers\ApiPapersController;
use src\controllers\ApiReadingListController;
use src\controllers\ApiUserController;
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
    case 'api/authors':
        new ApiAuthorsController($request, $response);
        break;
    case 'api/papers':
        new ApiPapersController($request, $response);
        break;
    case 'api/affiliations':
        new ApiAffiliationController($request, $response);
        break;
    case 'api/reading_list':
        new ApiReadingListController($request, $response);
        break;
    case 'api/authenticate':
        new ApiAuthenticateController($request, $response);
        break;
    case 'api/user':
        new ApiUserController($request, $response);
        break;
    case 'api/update_user':
        new ApiUpdateUserController($request, $response);
        break;
    case 'api/charities':
        new ApiCharitiesController($request, $response);
        break;
    case 'api/edit_charity':
        new ApiEditCharityController($request, $response);
        break;
    case 'api/suppapp_users':
        new ApiSuppAppUsersController($request, $response);
        break;
    case 'api/support_users':
        new ApiSupportUsersController($request, $response);
        break;
    case 'api/edit_support_users':
        new ApiEditSupportUserController($request, $response);
        break;
    case 'api/veterans':
        new ApiVeteranUsersController($request, $response);
        break;
    case 'api/charity_lead':
        new ApiCharityLeadController($request, $response);
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
