<?php

namespace src\gateways;

class VeteranUsersGateway extends Gateway {

    private $sql = "SELECT * FROM user";

    public function __construct() {
        $this->setDatabase(USER_DATABASE);
    }

    public function findAllVeteranUsers() {
        $this->sql .= "
            WHERE type_id = 5 
            ORDER BY id";
        $result = $this->getDatabase()->executeSQL($this->sql);
        $this->setResult($result);
    }

    public function findTypeAndCharityById($id) {
        $sql = "SELECT type_id, charity_id FROM user WHERE id = :id";
        $params = [":id" => $id];
        $result = $this->getDatabase()->executeSQL($sql, $params);
        $this->setResult($result);
    }

    public function findVeteranUsersByTypeId($charity_id) {
        $sql = "SELECT id, email, type_id, charity_id FROM user WHERE type_id = 5 AND charity_id = :charity_id";
        $params = [":charity_id" => $charity_id];
        $result = $this->getDatabase()->executeSQL($sql, $params);
        $this->setResult($result);
    }

}
