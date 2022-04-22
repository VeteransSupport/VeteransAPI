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
        $sql = "SELECT user.id, user.email, user.type_id, user.charity_id, charities.title FROM user JOIN charities WHERE (user.charity_id = charities.id) AND charities.id = :charity_id AND type_id = 5";
        $params = [":charity_id" => $charity_id];
        $result = $this->getDatabase()->executeSQL($sql, $params);
        $this->setResult($result);
    }

    public function findVeteranUsers() {
        $sql = "SELECT user.id, user.email, user.type_id, user.charity_id, charities.title FROM user JOIN charities WHERE (user.charity_id = charities.id) AND type_id = 5";
        $result = $this->getDatabase()->executeSQL($sql);
        $this->setResult($result);
    }
}
