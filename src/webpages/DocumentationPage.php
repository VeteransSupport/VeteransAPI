<?php
namespace src\webpages;

/**
 * Generates a valid HTML5 Documentation page.
 * addHeading2() and addBreak() can be used to
 * add content to the page.
 *
 * @author pervaiz Ahmad w18014333
 */
class DocumentationPage extends Webpage
{
    /**
     * Adds a subheading (h2) to the main contents of the page
     * 
     * @param string $class     Name for the class attribute
     * @param string $content   The contents of the h1 tag
     */
    public function addHeading2($class, $content) {
        parent::addToMain("        <h2" . parent::toClass($class) . ">" . $content . "</h2>\n");
    }

    /**
     * Returns a string surrounded by (strong) tags to make it bold.
     * Does not add to the main contents of the page.
     *
     * @param string $content   The contents of the strong tag
     */
    public function addStrong($content) {
        return "<strong>" . $content . "</strong>";
    }

    /**
     * Adds a break (br) to the main contents of the page
     */
    public function addBreak() {
        parent::addToMain("        <br/>\n");
    }

    /**
     * Creates link (a) link tag with the class and address provided
     *
     * @param string $class     Name for the class attribute
     * @param string $address   Link for the address attribute
     * @param string $content   The content of the link (a) tag
     * @return string           The string tag and its contents
     */
    public function toLink($class, $address, $content) {
        return "<a" . parent::toClass($class) . " href='". $address . "'>" . $content . "</a>";
    }
}
