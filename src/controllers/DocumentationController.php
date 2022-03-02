<?php
namespace src\controllers;

use src\webpages\DocumentationPage;

/**
 * The controller for the human-readable documentation page
 *
 * @author Pervaiz Ahmad w18014333
 */
class DocumentationController extends Controller {
    /**
     * Creates the contents of the documentation webpage
     * and returns the generated page to be displayed
     *
     * @return string The generated documentation page
     */
    protected function processRequest() {
        $page = new DocumentationPage("Documentation","assets/styles.css");



        return $page->generateWebpage();
    }
}
