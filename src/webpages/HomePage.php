    <?php
namespace src\webpages;

/**
 * Generates a valid HTML5 Home page.
 * Can use the addImage() method to
 * add an image to the home page.
 *
 * @author pervaiz Ahmad w18014333
 */
class HomePage extends Webpage
{
    /**
     * Adds an image to the webpage
     *
     * @param string $class     Name for the class attribute
     * @param string $filepath  The path of the image file
     * @param string $alt       The alt text for the image
     */
    public function addImage($class, $filepath, $alt) {
        $path = BASEPATH . "assets/$filepath";
        $this->addToMain("        <img" . $this->toClass($class) . " src='$path' alt='$alt'>\n");
    }
}
