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
}
