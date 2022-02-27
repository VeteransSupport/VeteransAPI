<?php
namespace src\webpages;

/**
 * Generates a valid HTML5 Error page
 *
 * @author pervaiz Ahmad w18014333
 */
class ErrorPage extends Webpage
{
    /**
     * Creates ands a div tag to the main contents of a webpage
     *
     * @param string $class     Name for the class attribute
     * @param string $content   The content of the division tag
     */
    public function addDiv($class, $content) {
        $class = parent::toClass($class);
        $div = <<<DIV
        <div$class>
$content
        </div>

DIV;
        parent::addToMain($div);
    }

    /**
     * Creates and returns a heading tag with a class
     *
     * @param string $class     Name for the class attribute
     * @param string $content   The content of the heading (h1) tag
     * @return string           The heading tag and its contents
     */
    public function toHeading1($class, $content) {
        return "            <h1" . parent::toClass($class) . ">" . $content . "</h1>";
    }

    /**
     * Creates and returns a subheading tag with a class
     *
     * @param string $class     Name for the class attribute
     * @param string $content   The content of the subheading (h2) tag
     * @return string           The subheading tag and its contents
     */
    public function toHeading2($class, $content) {
        return "            <h2" . parent::toClass($class) . ">" . $content . "</h2>";
    }

    /**
     * Creates and returns a paragraph tag with a class
     *
     * @param string $class     Name for the class attribute
     * @param string $content   The content of the paragraph tag
     * @return string           The paragraph tag and its contents
     */
    public function toParagraph($class, $content) {
        return "            <p" . parent::toClass($class) . ">" . $content . "</p>";
    }

    /**
     * Creates and returns a span tag with a class and an
     * onClick event attached to it
     *
     * @param string $class     Name for the class attribute
     * @param string $script    Script for the onClick attribute
     * @param string $content   The content of the span tag
     * @return string           The span tag and its contents
     */
    public function toSpanWithClick($class, $script, $content) {
        $onClick = "";
        if ($script !== "") {
            $onClick = " onclick='$script'";
        }
        return "<span" . parent::toClass($class) . $onClick . ">" . $content . "</span>";
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

    /**
     * Generates a full HTML5 error webpage
     *
     * @return string The complete error webpage
     */
    public function generateWebpage() {
        parent::setMain();
        return parent::getPageStart() . parent::getMain() . parent::getPageEnd();
    }
}
