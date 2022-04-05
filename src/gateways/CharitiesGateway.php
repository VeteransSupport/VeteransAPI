<?php

namespace src\gateways;

class CharitiesGateway extends Gateway {

    private $sql = "SELECT * FROM charities";

    public function __construct() {
        $this->setDatabase(USER_DATABASE);
    }

    public function findAll() {
        $this->sql .= " ORDER BY title";
        $result = $this->getDatabase()->executeSQL($this->sql);
        $this->setResult($result);
    }

    public function findById($id) {
        $this->sql .= " WHERE id = :id";
        $params = ["id" => $id];
        $result = $this->getDatabase()->executeSQL($this->sql, $params);
        $this->setResult($result);
    }

    public function findTypeById($id) {
        $sql = "SELECT type_id FROM user WHERE id = :id";
        $params = [":id" => $id];
        $result = $this->getDatabase()->executeSQL($sql, $params);
        $this->setResult($result);
    }

    public function editCharityById($id, $title, $description, $image) {
        $this->sql = "UPDATE charities SET title = :title, description = :description, image = :image WHERE id = :id";
        $params = [":id" => $id, ":title" => $title, ":description" => $description, ":image" => $image];
        $result = $this->getDatabase()->executeSQL($this->sql, $params);
        $this->setResult($result);
    }

    public function createCharity($title, $description, $image) {
        $this->sql = "INSERT INTO charities (title, description, image) VALUES (:title, :description, :image)";
        $params = [":title" => $title, ":description" => $description, ":image" => $image];
        $result = $this->getDatabase()->executeSQL($this->sql, $params);
        $this->setResult($result);
    }

    public function deleteCharityById($id) {
        $this->sql = "DELETE FROM charities WHERE id = :id";
        $params = [":id" => $id];
        $result = $this->getDatabase()->executeSQL($this->sql, $params);
        $this->setResult($result);
    }
}
