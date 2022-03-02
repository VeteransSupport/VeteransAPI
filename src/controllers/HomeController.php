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
        $page->addParagraph("text", "Add info");
        
        $page->addHeading1("heading adjust-top", "Declaration");
        $page->addImage("adjustLogo", "northumbria_logo.png", "Northumbria University Logo");
        return $page->generateWebpage();
    }
}
