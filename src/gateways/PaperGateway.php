<?php
namespace src\gateways;

/**
 * This gateway queries the DIS database and returns papers.
 * There are endpoints which return specific papers such as
 * _findById()_ which returns a paper with a given id.
 *
 * The Papers are ordered by their title.
 *
 * @author Pervaiz Ahmad w18014333
 */
class PaperGateway extends Gateway
{

    private $sql = "SELECT p.paper_id,
		p.title AS paper_title,
		p.abstract AS paper_abstract,
		p.doi AS paper_doi,
		p.video AS paper_video,
		p.preview AS paper_preview,
		awt.award_type_id,
		awt.name AS award_type_name
FROM paper AS p
LEFT JOIN award AS aw ON (p.paper_id = aw.paper_id)
LEFT JOIN award_type AS awt ON (aw.award_type_id = awt.award_type_id)";

    /**
     * Sets the database as the DIS_DATABASE
     * constant defined in the config file.
     */
    public function __construct()
    {
        $this->setDatabase(DIS_DATABASE);
    }

    /**
     * Query the database for all papers.
     */
    public function findAll()
    {
        $this->sql .= " ORDER BY REPLACE(REPLACE(p.title, '\"', ''), '“', '') ASC"; //
        $result = $this->getDatabase()->executeSQL($this->sql);
        $this->setResult($result);
    }

    /**
     * Query the database for papers with a given id.
     *
     * @param $id string The paper id
     */
    public function findById($id)
    {
        $this->sql .= " WHERE p.paper_id = :id";
        $params = ["id" => $id];
        $result = $this->getDatabase()->executeSQL($this->sql, $params);
        $this->setResult($result);
    }

    /**
     * Query the database for papers with a given author id.
     *
     * @param $author_id string The author id
     */
    public function findByAuthorId($author_id)
    {
        $this->sql .= " LEFT JOIN paper_author AS pa ON (p.paper_id = pa.paper_id) LEFT JOIN author AS a ON (pa.author_id = a.author_id) WHERE a.author_id = :author_id ORDER BY REPLACE(REPLACE(p.title, '\"', ''), '“', '') ASC";
        $params = ["author_id" => $author_id];
        $result = $this->getDatabase()->executeSQL($this->sql, $params);
        $this->setResult($result);
    }

    /**
     * Query the database for papers based on their awards.
     * If the award parameter is "all", all papers with an
     * award are returned. If the award parameter is "none",
     * all papers without an award are returned.
     *
     * @param $award string The award flag
     */
    public function findByAward($award)
    {
        if ($award == 'all') {
            $this->sql .= " WHERE aw.award_type_id IS NOT NULL ORDER BY REPLACE(REPLACE(p.title, '\"', ''), '“', '') ASC";
            $result = $this->getDatabase()->executeSQL($this->sql);
            $this->setResult($result);
        } else if ($award == 'none') {
            $this->sql .= " WHERE aw.award_type_id IS NULL ORDER BY REPLACE(REPLACE(p.title, '\"', ''), '“', '') ASC";
            $result = $this->getDatabase()->executeSQL($this->sql);
            $this->setResult($result);
        }
    }

    /**
     * Query the database for papers with a given award type id.
     *
     * @param $id string The award type id
     */
    public function findByAwardId($id)
    {
        $this->sql .= " WHERE aw.award_type_id = :id ORDER BY REPLACE(REPLACE(p.title, '\"', ''), '“', '') ASC";
        $params = ["id" => $id];
        $result = $this->getDatabase()->executeSQL($this->sql, $params);
        $this->setResult($result);
    }

    /**
     * Finds papers whose titles contain a given string.
     *
     * @param $title string The paper title
     */
    public function findInTitle($title)
    {
        $this->sql .= " WHERE p.title like :title ORDER BY REPLACE(REPLACE(p.title, '\"', ''), '“', '') ASC";
        $params = ["title" => "%".$title."%"];
        $result = $this->getDatabase()->executeSQL($this->sql, $params);
        $this->setResult($result);
    }

    /**
     * Finds papers whose abstracts contain a given string.
     *
     * @param $abstract string The paper abstract
     */
    public function findInAbstract($abstract)
    {
        $this->sql .= " WHERE p.abstract like :abstract ORDER BY REPLACE(REPLACE(p.title, '\"', ''), '“', '') ASC";
        $params = ["abstract" => "%".$abstract."%"];
        $result = $this->getDatabase()->executeSQL($this->sql, $params);
        $this->setResult($result);
    }
}
