<?php
namespace src\gateways;

/**
 * This gateway queries the User database and returns their
 * reading list. The _findAll()_ returns the entire reading list
 * of a specific user. The _add()_ and _remove()_ add and remove
 * papers with a given id for a specific user with a given user id.
 */
class ReadingListGateway extends Gateway  {

    public function __construct() {
        $this->setDatabase(USER_DATABASE);
    }

    public function findAll($user_id) {
        $sql = "SELECT DISTINCT paper_id FROM reading_list WHERE user_id = :user_id";
        $params = [":user_id" => $user_id];
        $result = $this->getDatabase()->executeSQL($sql, $params);
        $this->setResult($result);
    }

    public function add($user_id, $paper_id) {
        $sql = "INSERT into reading_list (user_id, paper_id) VALUES (:user_id, :paper_id)";
        $params = [":user_id" => $user_id, ":paper_id" => $paper_id];
        $result = $this->getDatabase()->executeSQL($sql, $params);
    }

    public function remove($user_id, $paper_id) {
        $sql = "DELETE from reading_list where (user_id = :user_id) AND (paper_id = :paper_id)";
        $params = [":user_id" => $user_id, ":paper_id" => $paper_id];
        $result = $this->getDatabase()->executeSQL($sql, $params);
    }
}
