<?php
namespace src\controllers;

use src\webpages\HomePage;

/**
 * The controller for the human-readable home page
 *
 * @author Pervaiz Ahmad w18014333
 */
class HomeController extends Controller {
    /**
     * Creates the contents of the home webpage
     * and returns the generated page to be displayed
     *
     * @return string The generated home page
     */
    protected function processRequest() {
        $page = new HomePage("Home","assets/styles.css");

        $page->addHeading1("heading adjust-top", "Student Info");
        $page->addParagraph("myinfo", "Name" . $page->toSpan("semicolon", ":") . "Pervaiz Ahmad");
        $page->addParagraph("myinfo", "ID" . $page->toSpan("semicolon", ":") . "w18014333");

        $page->addHeading1("heading", "Info");
        $page->addParagraph("text", "This web application presents information about academic papers on the topic of Designing Interactive Systems (DIS).
                                                   The target audience are people interested in discovering and reading DIS research papers. This is the API home page
                                                   and presents information about the API so it can be easily understood and used. The documentation for the API can be
                                                   found on the documentation page (link located in the navigation bar at the top). The documentation page lists the API
                                                   endpoints along with their descriptions as well as expected results for given parameters.");
        
        $page->addHeading1("heading adjust-top", "Declaration");
        $page->addParagraph("text", "This website is university coursework and not associated with or endorsed by the DIS conference.");
        $page->addImage("adjustLogo", "northumbria_logo.png", "Northumbria University Logo");
        return $page->generateWebpage();
    }
}
