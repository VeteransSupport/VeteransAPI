<?php
namespace src\webpages;

/**
 * Generates a webpage.
 *
 * This class will create a valid HTML5 webpage.
 * Can use addHeading1() and addParagraph() to add
 * content to the webpage. generateWebpage() method
 * will return the generated webpage as a string.
 *
 * @author Pervaiz Ahmad w18014333
 */
abstract class Webpage
{
    private $css;
    private $pageStart;
    private $pageEnd;

    private $header;
    private $main;
    private $footer;

    private $mainContent;

    /**
     * Creates the head and foot of the page.
     * This will be a valid HTML5 page with a basic layout
     * without any content.
     * 
     * @param string $pageTitle Text for the browser's title bar
     * @param string $css       Link for a css file
     */
    public function __construct($pageTitle, $css) {
        $this->main = "";
        $this->setCSS(BASEPATH . $css);
        $this->setPageStart($pageTitle);
        $this->setHeader($pageTitle);
        $this->setFooter();
        $this->setPageEnd();
    }

    /**
     * Sets the css path for the webpage
     * 
     * @param string $css   Path to the css file
     */
    public function setCSS($css) {
        $this->css = $css;
    }

    /**
     * Adds a heading (h1) to the main contents of the page
     * 
     * @param string $class     Name for the class attribute
     * @param string $heading   The Contents of the h1 tag
     */
    public function addHeading1($class, $heading) {
        $this->addToMain("        <h1" . $this->toClass($class) . ">" . $heading . "</h1>\n");
    }

    /**
     * Adds a paragraph (p) to the main contents of the page
     * 
     * @param string $class     Name for the class attribute
     * @param string $paragraph The Contents of the p tag
     */
    public function addParagraph($class, $paragraph) {
        $this->addToMain("        <p" . $this->toClass($class) . ">" . $paragraph . "</p>\n");
    }

    /**
     * Converts and returns content in the form of a span tag
     * with a class provided
     * 
     * @param string $class     Name for the class attribute
     * @param string $content   The content of the span tag
     * 
     * @return string The span tag with the
     */
    public function toSpan($class, $content) {
        return "<span" . $this->toClass($class) . ">" . $content . "</span>";
    }

    /**
     * Generates a full HTML5 webpage
     *
     * @return string The complete webpage
     */
    public function generateWebpage() {
        $this->setMain();
        return $this->getPageStart() . $this->getHeader() . $this->getMain() . $this->getFooter() . $this->getPageEnd();
    }

    /**
     * Adds content to include in the main tags
     *
     * @param string $content   The content to be added into the main tags
     */
    protected function addToMain($content) {
        $this->mainContent .= $content;
    }

    /**
     * Creates the head and save to $this->head
     * 
     * @param string $title Text for the browser's title bar
     */
    private function setPageStart($title) {
        $this->pageStart = <<<PAGESTART
<!DOCTYPE html>
<html lang="en-GB">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Web application that presents information about academic papers on the topic of Designing Interactive Systems. Not associated with DIS, its partner organisations or sponsors.">
    <meta name="author" content="Pervaiz Ahmad">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="$this->css" media="all">

    <title>$title</title>
</head>
<body>

PAGESTART;
    }

    /**
     * Returns the start of the webpage
     * including the start of the body tag
     * 
     * @return string The start of the webpage
     */
    protected function getPageStart() {
        return $this->pageStart;
    }

    /**
     * Creates the ending of the webpage with
     * the closing body and html tags
     */
    private function setPageEnd() {
        $this->pageEnd = <<<PAGEEND
</body>
</html>
PAGEEND;
    }

    /**
     * Returns the end of the webpage including
     * the closing body and html tags
     * 
     * @return string The end of the webpage
     */
    protected function getPageEnd() {
        return $this->pageEnd;
    }

    /**
     * Creates the header tag with a nav bar
     */
    private function setHeader($pageName) {
        $hActive = "";
        $dActive = "";

        if ($pageName === "Home") {
            $hActive = ' id="active"';
        } else if ($pageName === "Documentation") {
            $dActive = ' id="active"';
        }

        $this->header = <<<HEADER
    <header>
        <nav>
            <ul>
                <li><a$hActive href="home">Home</a></li>
                <li><a$dActive href="documentation">Documentation</a></li>
            </ul>
        </nav>
    </header>

HEADER;
    }

    /**
     * Returns the header tag with its contents
     * 
     * @return string The header tags with its content
     */
    private function getHeader() {
        return $this->header;
    }

    /**
     * Creates the main tag and sets its contents
     */
    protected function setMain() {
        $this->main = <<<MAIN
    <main>
$this->mainContent    </main>

MAIN;
    }

    /**
     * Returns the main tag with its contents
     * 
     * @return string The main tags with the
     *                main content
     */
    protected function getMain() {
        return $this->main;
    }

    /**
     * Creates the footer tag with its contents
     */
    private function setFooter() {
        $this->footer = <<<FOOTER
    <footer>
		<div class="footerInfo">
			<section class="fSections">
				<h2>Location</h2>
				<p>Newcastle Upon Tyne</p>
			</section>
			<section class="fSections">
				<h2>University</h2>
				<p>Northumbria University</p>
			</section>
			<section class="fSections">
				<h2>Contact Email</h2>
				<p>pervaiz2.ahmad@northumbria.ac.uk</p>
			</section>
		</div>
		
		<hr/> <!-- Footer separation line -->
		
		<div class="footerEndNote">
			<p>Designed by Pervaiz Ahmad</p>
		</div>
	</footer>

FOOTER;
    }

    /**
     * Returns the footer tag with its contents
     * 
     * @return string The footer tags with the
     *                footer content
     */
    private function getFooter() {
        return $this->footer;
    }

    /**
     * Creates and returns the class attribute
     * using a class name provided. If class name
     * isn't provided an empty string is returned.
     * 
     * @param string $className Name for the class attribute
     * @return string           The class attribute to be added
     *                          into a html element
     */
    protected function toClass($className) {
        if ($className !== "") {
            return " class='$className'";
        } else return "";
    }
}
