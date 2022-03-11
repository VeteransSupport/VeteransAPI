<?php
namespace src\gateways;

/**
 * This gateway queries the DIS database and returns affiliations.
 * There are endpoints which return specific authors such as
 * _findByPaperAndAuthorId_ which returns an affiliations with the
 * given paper and author id.
 *
 * @author Pervaiz Ahmad w18014333
 */
class AffiliationGateway extends Gateway {

    private $sql = "SELECT * FROM affiliation";

    /**
     * Sets the database as the DIS_DATABASE
     * constant defined in the config file.
     */
    public function __construct() {
        $this->setDatabase(DIS_DATABASE);
    }

    /**
     * Query the database for all affiliations
     */
    public function findAll()
    {
        $result = $this->getDatabase()->executeSQL($this->sql);
        $this->setResult($result);
    }

    /**
     * Query the database for affiliations
     * with a given paper_id and author_id
     *
     * @param $paper_id string  The paper id
     * @param $author_id string The author id
     */
    public function findByPaperAndAuthorId($paper_id, $author_id)
    {
        $this->sql .= " WHERE paper_id = :paper_id AND author_id = :author_id";
        $params = ["paper_id" => $paper_id, "author_id" => $author_id];
        $result = $this->getDatabase()->executeSQL($this->sql, $params);
        $this->setResult($result);
    }

    /**
     * Query the database for affiliations
     * with a given paper_id
     *
     * @param $paper_id string The paper id
     */
    public function findInPaperId($paper_id)
    {
        $this->sql .= " WHERE paper_id = :paper_id";
        $params = ["paper_id" => $paper_id];
        $result = $this->getDatabase()->executeSQL($this->sql, $params);
        $this->setResult($result);
    }

    /**
     * Query the database for affiliations
     * with a given author_id
     *
     * @param $author_id string The author id
     */
    public function findInAuthorId($author_id)
    {
        $this->sql .= " WHERE author_id = :author_id";
        $params = ["author_id" => $author_id];
        $result = $this->getDatabase()->executeSQL($this->sql, $params);
        $this->setResult($result);
    }

    /**
     * Query the database for affiliations
     * with a given country name
     *
     * @param $country string The country where the paper was written
     */
    public function findInCountry($country)
    {
        $this->sql .= " WHERE country = :country";
        $params = ["country" => $country];
        $result = $this->getDatabase()->executeSQL($this->sql, $params);
        $this->setResult($result);
    }

    /**
     * Query the database for affiliations
     * with a given state name
     *
     * @param $state string The state where the paper was written
     */
    public function findInState($state)
    {
        $this->sql .= " WHERE state = :state";
        $params = ["state" => $state];
        $result = $this->getDatabase()->executeSQL($this->sql, $params);
        $this->setResult($result);
    }

    /**
     * Query the database for affiliations
     * with a given city name
     *
     * @param $city string The city where the paper was written
     */
    public function findInCity($city)
    {
        $this->sql .= " WHERE city = :city";
        $params = ["city" => $city];
        $result = $this->getDatabase()->executeSQL($this->sql, $params);
        $this->setResult($result);
    }

    /**
     * Query the database for affiliations
     * with a given institution name
     *
     * @param $institution string The institution where the paper was written
     */
    public function findInInstitution($institution)
    {
        $this->sql .= " WHERE institution = :institution";
        $params = ["institution" => $institution];
        $result = $this->getDatabase()->executeSQL($this->sql, $params);
        $this->setResult($result);
    }

    /**
     * Query the database for affiliations
     * with a given department name
     *
     * @param $department string The department where the paper was written
     */
    public function findInDepartment($department)
    {
        $this->sql .= " WHERE department = :department";
        $params = ["department" => $department];
        $result = $this->getDatabase()->executeSQL($this->sql, $params);
        $this->setResult($result);
    }
}
