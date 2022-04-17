<?php

namespace src\gateways;

class CharityLeadGateway extends Gateway {

    private $sql = "SELECT * FROM user";

    public function __construct() {
        $this->setDatabase(USER_DATABASE);
    }

    public function findCharityLeadByTypeID() {
        $sql = "SELECT * FROM user WHERE type_id = 3 ORDER BY id";
        $result = $this->getDatabase()->executeSQL($sql);
        $this->setResult($result);
    }

    public function findById($id) {
        $this->sql .= " WHERE id = :id";
        $params = ["id" => $id];
        $result = $this->getDatabase()->executeSQL($this->sql, $params);
        $this->setResult($result);
    }

    public function findTypeAndCharityById($id) {
        $sql = "SELECT type_id, charity_id FROM user WHERE id = :id";
        $params = [":id" => $id];
        $result = $this->getDatabase()->executeSQL($sql, $params);
        $this->setResult($result);
    }

    public function findCharityAdminAndVeteransByCharityId($charity_id) {
        $sql = "SELECT id, email, type_id, charity_id FROM user WHERE (type_id = 5 OR type_id = 3) AND charity_id = :charity_id";
        //SELECT id, email, type_id, charity_id FROM user WHERE type_id = 3 AND charity_id = :charity_id
        //SELECT id, email, type_id, charity_id FROM user WHERE charity_id = :charity_id AND type_id = 5 OR type_id = 3
        $params = [":charity_id" => $charity_id];
        $result = $this->getDatabase()->executeSQL($sql, $params);
        $this->setResult($result);
    }

    public function findCharityOfSupportUserById($charity_id, $id) {
        $sql = "SELECT * from charities join user where (charities.id = user.charity_id) AND charities.id = :charity_id AND user.id = :id";
        $params = [":id" => $id, ":charity_id" => $charity_id];
        $result = $this->getDatabase()->executeSQL($sql, $params);
        $this->setResult($result);
    }
}
