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

        $page->addHeading1("heading", "API Info");
        $page->addParagraph("text", "Below are the endpoints for this REST API. These can be tested in the browsers using the links given. The main endpoint link is provided in full next to every endpoint heading. Note that some endpoints will return a \"405 : Method not allowed\" error message which is expected behaviour. Also note that when testing, if no data is returned by the endpoint the browser will not refresh the page or show the \"204 : No Content\" error message, therefore you will not see en empty response.");

        $page->addHeading1("heading", "API Endpoints");
        $page->addHeading2("subheading", "api" . $page->toLink("adjust-top adjust-left apiLink", "http://unn-w18014333.newnumyspace.co.uk/kf6012/coursework/part1/api", "http://unn-w18014333.newnumyspace.co.uk/kf6012/coursework/part1/api"));
        $page->addParagraph("text", "This is the base API endpoint which supports both GET and POST requests and it takes no parameters.");
        $page->addParagraph("text", "It returns the author of this API containing the name and id, a short explanation of what the API is, and a link to the documentation page.");
        $page->addBreak();
        $page->addParagraph("text", $page->addStrong("The following are likely HTTP status codes for this API:"));
        $page->addParagraph("text", $page->addStrong("Status code 404: ") . "No error messages are returned unless the API endpoint is miss-spelled, in which case a \"404 : not found\" error message will be returned. This applies to all endpoints in this API.");
        $page->addParagraph("text", $page->addStrong("Status code 200: ") . "If no errors occur, a \"200 : OK\" status code is returned.");
        $page->addBreak();

        $page->addHeading2("subheading", "api/authors" . $page->toLink("adjust-top adjust-left apiLink", "http://unn-w18014333.newnumyspace.co.uk/kf6012/coursework/part1/api/authors", "http://unn-w18014333.newnumyspace.co.uk/kf6012/coursework/part1/api/authors"));
        $page->addParagraph("text", "This is the authors endpoint which supports only GET requests. Data returned contains author_id, first_name, middle_name, last_name. The Authors are ordered by first_name. If NONE of the supported parameters are used in this API call, all authors are returned as a result.");
        $page->addBreak();
        $page->addParagraph("text", $page->addStrong("The following are likely HTTP status codes for this API:"));
        $page->addParagraph("text", $page->addStrong("Status code 204: ") . "If no data is returned, a \"204 : no content\" error message is returned.");
        $page->addParagraph("text", $page->addStrong("Status code 405: ") . "If a method other than GET is used, a \"405 : method not allowed\" error message will be returned.");
        $page->addParagraph("text", $page->addStrong("Status code 200: ") . "If no errors occur, a \"200 : OK\" status code is returned.");
        $page->addBreak();
        $page->addParagraph("text", $page->addStrong("This endpoint takes the following parameters:"));
        $page->addParagraph("text", $page->addStrong("id: ") . "Returns one author with the given author_id, e.g. " . $page->toLink("adjust-top apiEx", "api/authors?id=59463", "api/authors?id=59463"));
        $page->addParagraph("text", $page->addStrong("first_name & last_name: ") . "Returns all authors who's first and last names contains the strings given, e.g. " . $page->toLink("adjust-top apiEx", "api/authors?first_name=john&last_name=porter", "api/authors?first_name=john&last_name=porter"));
        $page->addParagraph("text", $page->addStrong("first_name: ") . "Returns all authors who's first name contains the string given, e.g. " . $page->toLink("adjust-top apiEx", "api/authors?first_name=john", "api/authors?first_name=john"));
        $page->addParagraph("text", $page->addStrong("middle_name: ") . "Returns all authors who's middle name contains the string given, e.g. " . $page->toLink("adjust-top apiEx", "api/authors?middle_name=r", "api/authors?middle_name=r"));
        $page->addParagraph("text", $page->addStrong("last_name: ") . "Returns all authors who's last name contains the string given, e.g. " . $page->toLink("adjust-top apiEx", "api/authors?last_name=porter", "api/authors?last_name=porter"));
        $page->addParagraph("text", $page->addStrong("paper_id: ") . "Returns all the authors of a paper using a given paper_id, e.g. " . $page->toLink("adjust-top apiEx", "api/authors?paper_id=60195", "api/authors?paper_id=60195"));
        $page->addBreak();

        $page->addHeading2("subheading", "api/papers" . $page->toLink("adjust-top adjust-left apiLink", "http://unn-w18014333.newnumyspace.co.uk/kf6012/coursework/part1/api/papers", "http://unn-w18014333.newnumyspace.co.uk/kf6012/coursework/part1/api/papers"));
        $page->addParagraph("text", "This is the papers endpoint which supports only GET requests. Data returned contains paper_id, paper_title, paper_abstract, paper_doi, paper_video, paper_preview, award_type_id, award_type_name. The Papers are ordered by paper_title. If NONE of the supported parameters are used in this API call, all papers are returned as a result.");
        $page->addBreak();
        $page->addParagraph("text", $page->addStrong("The following are likely HTTP status codes for this API:"));
        $page->addParagraph("text", $page->addStrong("Status code 204: ") . "If no data is returned, a \"204 : no content\" error message is returned.");
        $page->addParagraph("text", $page->addStrong("Status code 405: ") . "If a method other than GET is used, a \"405 : method not allowed\" error message will be returned.");
        $page->addParagraph("text", $page->addStrong("Status code 200: ") . "If no errors occur, a \"200 : OK\" status code is returned.");
        $page->addBreak();
        $page->addParagraph("text", $page->addStrong("This endpoint takes the following parameters:"));
        $page->addParagraph("text", $page->addStrong("id: ") . "Returns one paper with the given paper_id, e.g. " . $page->toLink("adjust-top apiEx", "api/papers?id=60071", "api/papers?id=60071"));
        $page->addParagraph("text", $page->addStrong("author_id: ") . "Returns all papers of one author with the given author_id, e.g. " . $page->toLink("adjust-top apiEx", "api/papers?author_id=59687", "api/papers?author_id=59687"));
        $page->addParagraph("text", $page->addStrong("award: ") . "Returns all papers that have an award or all papers that do not have an award. The parameter can therefore be either \"all\" or \"none\", e.g. " . $page->toLink("adjust-top apiEx", "api/papers?award=all", "api/papers?award=all") . " OR " . $page->toLink("adjust-top apiEx", "api/papers?award=none", "api/papers?award=none"));
        $page->addParagraph("text", $page->addStrong("award_id: ") . "Returns all papers with a given award_id, e.g. " . $page->toLink("adjust-top apiEx", "api/papers?award_id=1", "api/papers?award_id=1"));
        $page->addParagraph("text", $page->addStrong("title: ") . "Returns all papers who's title contains the given string, e.g. " . $page->toLink("adjust-top apiEx", "api/papers?title=covid", "api/papers?title=covid"));
        $page->addParagraph("text", $page->addStrong("abstract: ") . "Returns all papers who's abstract contains the given string, e.g. " . $page->toLink("adjust-top apiEx", "api/papers?abstract=hci", "api/papers?abstract=hci"));
        $page->addBreak();

        $page->addHeading2("subheading", "api/affiliations" . $page->toLink("adjust-top adjust-left apiLink", "http://unn-w18014333.newnumyspace.co.uk/kf6012/coursework/part1/api/affiliations", "http://unn-w18014333.newnumyspace.co.uk/kf6012/coursework/part1/api/affiliations"));
        $page->addParagraph("text", "This is the affiliations endpoint which supports only GET requests. Data returned contains paper_id, author_id, country, state, city, institution, department. If NONE of the supported parameters are used in this API call, all affiliations are returned as a result.");
        $page->addBreak();
        $page->addParagraph("text", $page->addStrong("The following are likely HTTP status codes for this API:"));
        $page->addParagraph("text", $page->addStrong("Status code 204: ") . "If no data is returned, a \"204 : no content\" error message is returned.");
        $page->addParagraph("text", $page->addStrong("Status code 405: ") . "If a method other than GET is used, a \"405 : method not allowed\" error message will be returned.");
        $page->addParagraph("text", $page->addStrong("Status code 200: ") . "If no errors occur, a \"200 : OK\" status code is returned.");
        $page->addBreak();
        $page->addParagraph("text", $page->addStrong("This endpoint takes the following parameters:"));
        $page->addParagraph("text", $page->addStrong("paper_id & author_id: ") . "Returns one affiliation with the given paper_id and author_id, e.g. " . $page->toLink("adjust-top apiEx", "api/affiliations?paper_id=60073&author_id=60058", "api/affiliations?paper_id=60073&author_id=60058"));
        $page->addParagraph("text", $page->addStrong("paper_id: ") . "Returns all affiliations with the given paper_id, e.g. " . $page->toLink("adjust-top apiEx", "api/affiliations?paper_id=60073", "api/affiliations?paper_id=60073"));
        $page->addParagraph("text", $page->addStrong("author_id: ") . "Returns all affiliations with the given author_id, e.g. " . $page->toLink("adjust-top apiEx", "api/affiliations?author_id=60058", "api/affiliations?author_id=60058"));
        $page->addParagraph("text", $page->addStrong("country: ") . "Returns all affiliations with the given country, e.g. " . $page->toLink("adjust-top apiEx", "api/affiliations?country=Denmark", "api/affiliations?country=Denmark"));
        $page->addParagraph("text", $page->addStrong("state: ") . "Returns all affiliations with the given state, e.g. " . $page->toLink("adjust-top apiEx", "api/affiliations?state=Hertfordshire", "api/affiliations?state=Hertfordshire"));
        $page->addParagraph("text", $page->addStrong("city: ") . "Returns all affiliations with the given city, e.g. " . $page->toLink("adjust-top apiEx", "api/affiliations?city=Tokyo", "api/affiliations?city=Tokyo"));
        $page->addParagraph("text", $page->addStrong("institution: ") . "Returns all affiliations with the given institution, e.g. " . $page->toLink("adjust-top apiEx", "api/affiliations?institution=Northumbria University", "api/affiliations?institution=Northumbria University"));
        $page->addParagraph("text", $page->addStrong("department: ") . "Returns all affiliations with the given department, e.g. " . $page->toLink("adjust-top apiEx", "api/affiliations?department=Computer Science", "api/affiliations?department=Computer Science"));
        $page->addBreak();

        $page->addHeading2("subheading", "api/authenticate" . $page->toLink("adjust-top adjust-left apiLink", "http://unn-w18014333.newnumyspace.co.uk/kf6012/coursework/part1/api/authenticate", "http://unn-w18014333.newnumyspace.co.uk/kf6012/coursework/part1/api/authenticate"));
        $page->addParagraph("text", "This is the authenticate endpoint which supports only POST requests. Data returned is a token which contains the JWT. This endpoint takes an username and a password as form-data in the body which must be present and a valid entry in the users database for the JWT to be returned. The JWT claims are as follows: user_id, email, iss, exp, iat.");
        $page->addBreak();
        $page->addParagraph("text", $page->addStrong("The following are likely HTTP status codes for this API:"));
        $page->addParagraph("text", $page->addStrong("Status code 405: ") . "If a method other than POST is used, a \"405 : method not allowed\" error message will be returned.");
        $page->addParagraph("text", $page->addStrong("Status code 401: ") . "If no form-data is provided in the body of the API call, if the data key's are misspelled, or if the username or password do not match any entries in the users database, a \"401 : Authorization Required\" error message will be returned.");
        $page->addParagraph("text", $page->addStrong("Status code 200: ") . "If no errors occur, a \"200 : OK\" status code is returned.");
        $page->addBreak();

        $page->addHeading2("subheading", "api/reading_list" . $page->toLink("adjust-top adjust-left apiLink", "http://unn-w18014333.newnumyspace.co.uk/kf6012/coursework/part1/api/reading_list", "http://unn-w18014333.newnumyspace.co.uk/kf6012/coursework/part1/api/reading_list"));
        $page->addParagraph("text", "This is the reading list endpoint which supports only POST requests. Data returned contains an array of paper_id. This endpoint takes a JWT as form-data in the body which must be present, valid, and within the expiration date. If a valid JWT is provided, the reading list for the logged in user is returned. The \"add\" and \"remove\" form-data are also used as defined below:");
        $page->addParagraph("text", $page->addStrong("add: ") . "This adds a given paper_id to the user's reading list.");
        $page->addParagraph("text", $page->addStrong("remove: ") . "This removes the given paper_id from the user's reading list.");
        $page->addBreak();
        $page->addParagraph("text", $page->addStrong("The following are likely HTTP status codes for this API:"));
        $page->addParagraph("text", $page->addStrong("Status code 405: ") . "If a method other than POST is used, a \"405 : method not allowed\" error message will be returned.");
        $page->addParagraph("text", $page->addStrong("Status code 401: ") . "If no form-data is provided in the body of the API call or if the data key is misspelled, a \"401 : Authorization Required\" error message will be returned.");
        $page->addParagraph("text", $page->addStrong("Status code 500: ") . "If the token data-field is not present or a wrong number of segments are used, a \"500 : Internal Server Error (Wrong number of segments)\" error message is returned.");
        $page->addParagraph("text", $page->addStrong("Status code 500: ") . "If the token format is correct but still does not match, a \"500 : Internal Server Error (Signature verification failed)\" error message is returned.");
        $page->addParagraph("text", $page->addStrong("Status code 200: ") . "If no errors occur, a \"200 : OK\" status code is returned.");
        $page->addBreak();

        $page->addHeading2("subheading", "api/update_user" . $page->toLink("adjust-top adjust-left apiLink", "http://unn-w18014333.newnumyspace.co.uk/kf6012/coursework/part1/api/update_user", "http://unn-w18014333.newnumyspace.co.uk/kf6012/coursework/part1/api/update_user"));
        $page->addParagraph("text", "This is the update user endpoint which supports only POST requests. No JSON data is returned by this API. This endpoint takes a username, password, and request as form-data in the body which must be present. The request form-data must either be \"add\" or \"remove\" to add or remove a user as defined below:");
        $page->addParagraph("text", $page->addStrong("username & password & request: ") . "If the request form-data is \"add\", a new user is added with the given username and password. If the request form-data is \"remove\" and the email and password match a user entry in the database, then that user is removed from the User database.");
        $page->addBreak();
        $page->addParagraph("text", $page->addStrong("The following are likely HTTP status codes for this API:"));
        $page->addParagraph("text", $page->addStrong("Status code 405: ") . "If a method other than POST is used, a \"405 : method not allowed\" error message will be returned.");
        $page->addParagraph("text", $page->addStrong("Status code 500: ") . "If a username which already exists in the database is being added, a \"500 : Internal Server Error\" error message will be returned.");
        $page->addParagraph("text", $page->addStrong("Status code 204: ") . "If no errors occur, a \"204 : No Content\" status code is returned as this endpoint doesnt return any data. This status code will therefore also be returned if a user who doesnt exist in the database is being removed or if the password provided does not match the email.");

        return $page->generateWebpage();
    }
}
