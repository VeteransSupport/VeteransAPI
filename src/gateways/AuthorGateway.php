<?php
namespace src\gateways;

/**
 * This gateway queries the DIS database and returns Authors.
 * There are endpoints which return specific Authors such as
 * _findById()_ which returns an Authors with a given id.
 *
 * The Authors are ordered by their first name.
 *
 * @author Pervaiz Ahmad w18014333
 */
class AuthorGateway extends Gateway {

    private $sql = "SELECT * FROM author";

    /**
     * Sets the database as the DIS_DATABASE
     * constant defined in the config file.
     */
    public function __construct() {
        $this->setDatabase(DIS_DATABASE);
    }

    /**
     * Query the database for all authors
     */
    public function findAll()
    {
        $this->sql .= " ORDER BY first_name";
        $result = $this->getDatabase()->executeSQL($this->sql);
        $this->setResult($result);
    }

    /**
     * Query the database for authors with a given id
     *
     * @param $id string The author's id
     */
    public function findById($id)
    {
        $this->sql .= " WHERE author_id = :id ORDER BY first_name";
        $params = ["id" => $id];
        $result = $this->getDatabase()->executeSQL($this->sql, $params);
        $this->setResult($result);
    }

    /**
     * Query the database for authors which
     * have a given first and last name
     *
     * @param $f_name string The author's first name
     * @param $l_name string The author's last name
     */
    public function findByFirstLastName($f_name, $l_name)
    {
        $this->sql .= " WHERE (first_name like :f_name AND last_name like :l_name) ORDER BY first_name";
        $params = ["f_name" => "%".$f_name."%", "l_name" => "%".$l_name."%"];
        $result = $this->getDatabase()->executeSQL($this->sql, $params);
        $this->setResult($result);
    }

    /**
     * Query the database for authors whose
     * first name contains a given string
     *
     * @param $name string The author's first name
     */
    public function findInFirstName($name)
    {
        $this->sql .= " WHERE first_name like :name ORDER BY first_name";
        $params = ["name" => "%".$name."%"];
        $result = $this->getDatabase()->executeSQL($this->sql, $params);
        $this->setResult($result);
    }

    /**
     * Query the database for authors whose
     * middle name contains a given string
     *
     * @param $name string The author's middle name
     */
    public function findInMiddleName($name)
    {
        $this->sql .= " WHERE middle_name like :name ORDER BY first_name";
        $params = ["name" => "%".$name."%"];
        $result = $this->getDatabase()->executeSQL($this->sql, $params);
        $this->setResult($result);
    }

    /**
     * Query the database for authors whose
     * last name contains a given string
     *
     * @param $name string The author's last name
     */
    public function findInLastName($name)
    {
        $this->sql .= " WHERE last_name like :name ORDER BY first_name";
        $params = ["name" => "%".$name."%"];
        $result = $this->getDatabase()->executeSQL($this->sql, $params);
        $this->setResult($result);
    }

    /**
     * Query the database for authors if a specific
     * paper with a given paper id
     *
     * @param $paper_id string The paper id
     */
    public function findByPaperId($paper_id)
    {
        $this->sql .= " WHERE author_id IN (SELECT author_id FROM paper_author WHERE paper_id = :paper_id) ORDER BY first_name";
        $params = ["paper_id" => $paper_id];
        $result = $this->getDatabase()->executeSQL($this->sql, $params);
        $this->setResult($result);
    }
}
