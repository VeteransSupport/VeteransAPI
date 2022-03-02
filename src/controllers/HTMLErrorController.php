<?php
namespace src\controllers;

use src\webpages\ErrorPage;

/**
 * Controller which returns a human-readable
 * error page if the request was not found.
 *
 * @author Pervaiz Ahmad w18014333
 */
class HTMLErrorController extends Controller {
    /**
     * Creates the contents of the error webpage
     * and returns the generated page to be displayed
     *
     * @return string The generated error page
     */
    protected function processRequest() {
        $page = new ErrorPage("Error","assets/styles.css");
        $page->addDiv("errInfo",
            $page->toHeading1("noselect errCode", "404") . "\n" .
            $page->toHeading2("noselect adjust-bottom errTnfo", "Not Found") . "\n" .
            $page->toParagraph("adjust-top", "The page you are looking for doesn't exist or an other error occurred. " .
                $page->toSpanWithClick("adjust-top backButton", "history.back()", "Go Back") .
                ", or head over to the " . $page->toLink("adjust-top backButton", "home", "Homepage") . "."
            )
        );
        return $page->generateWebpage();
    }
}
