<?php

namespace src\gateways;

class QuizGateway extends Gateway{

    private $sql = "SELECT * FROM quiz";

    public function __construct() {
        $this->setDatabase(USER_DATABASE);
    }

    public function findAll() {
        $result = $this->getDatabase()->executeSQL($this->sql);
        $this->setResult($result);
    }

    public function findById($id) {
        $this->sql .= " WHERE id = :id";
        $params = ["id" => $id];
        $result = $this->getDatabase()->executeSQL($this->sql, $params);
        $this->setResult($result);
    }
}
