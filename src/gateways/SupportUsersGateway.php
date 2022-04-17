<?php

namespace src\gateways;

class SupportUsersGateway extends Gateway {

    private $sql = "SELECT id, email, type_id, charity_id FROM user";

    public function __construct() {
        $this->setDatabase(USER_DATABASE);
    }

//    public function findAll() {
//        $this->sql .= " ORDER BY id";
//        $result = $this->getDatabase()->executeSQL($this->sql);
//        $this->setResult($result);
//    }

    public function findAllSupportUsers($charity_id) {
        $sql = "SELECT user.id, user.email, user.charity_id, charities.title FROM user JOIN charities WHERE (user.charity_id = charities.id) AND charities.id = :charity_id AND type_id = 4";
        $params = ["charity_id" => $charity_id];
        $result = $this->getDatabase()->executeSQL($sql, $params);
        $this->setResult($result);
    }
    //SELECT user.id, user.email, charities.title FROM user JOIN charities WHERE user.charity_id = charities.id AND type_id = 4
    //SELECT user.id, user.email, charities.title FROM charities JOIN user WHERE charities.id = user.charity_id AND user.type_id = 4

    public function findSupportUserById($id, $charity_id) {
        $this->sql .= " WHERE id = :id AND charity_id = :charity_id";
        $params = ["id" => $id, "charity_id" => $charity_id];
        $result = $this->getDatabase()->executeSQL($this->sql, $params);
        $this->setResult($result);
    }

    public function findTypeAndCharityById($id) {
        $sql = "SELECT type_id, charity_id FROM user WHERE id = :id";
        $params = [":id" => $id];
        $result = $this->getDatabase()->executeSQL($sql, $params);
        $this->setResult($result);
    }

//    public function findSupportUsersByTypeId($charity_id) {
//        $sql = "SELECT id, email, type_id, charity_id FROM user WHERE type_id = 4 AND charity_id = :charity_id";
//        $params = [":charity_id" => $charity_id];
//        $result = $this->getDatabase()->executeSQL($sql, $params);
//        $this->setResult($result);
//    }

    public function addCharitySupport($email, $password, $type_id, $charity_id) {
        $this->sql = "INSERT INTO user (email, password, type_id, charity_id) VALUES (:email, :password, :type_id, :charity_id)";
        $params = [":email" => $email, ":password" => $password, ":charity_id" => $charity_id, ":type_id" => $type_id];
        $result = $this->getDatabase()->executeSQL($this->sql, $params);
        $this->setResult($result);
    }

    public function deleteUserById($id) {
        $this->sql = "DELETE FROM user WHERE id = :id";
        $params = [":id" => $id];
        $result = $this->getDatabase()->executeSQL($this->sql, $params);
        $this->setResult($result);
    }

    public function editSupportUserById($id, $email, $password, $type_id, $charity_id) {
        $this->sql = "UPDATE user SET email = :email, password = :password, type_id = :type_id, charity_id = :charity_id WHERE id = :id";
        $params = [":id" => $id, ":email" => $email, ":password" => $password, ":type_id" => $type_id, ":charity_id" => $charity_id];
        $result = $this->getDatabase()->executeSQL($this->sql, $params);
        $this->setResult($result);
    }
}
