<?php
namespace src\gateways;

/**
 * This gateway queries the USER database for the
 * password associated with a username and returns
 * the hashed password stored in the database.
 *
 * @author Pervaiz Ahmad w18014333
 */
class UserGateway extends Gateway  {

    /**
     * Sets the database as the USER_DATABASE
     * constant defined in the config file.
     */
    public function __construct() {
        $this->setDatabase(USER_DATABASE);
    }

    /**
     * Finds the password using the user's username.
     *
     * @param $username string The user's username
     */
    public function findPassword($username) {
        $sql = "SELECT * FROM user WHERE email = :username";
        $params = [":username" => $username];
        $result = $this->getDatabase()->executeSQL($sql, $params);
        $this->setResult($result);
    }

    public function findTypeById($id) {
        $sql = "SELECT type_id FROM user WHERE id = :id";
        $params = [":id" => $id];
        $result = $this->getDatabase()->executeSQL($sql, $params);
        $this->setResult($result);
    }

    /**
     * Adds a new user to the User database using the
     * user's email and password
     *
     * @param $username string The username of the new user
     * @param $password string The password of the new user
     */
    public function addUser($username, $password, $type_id, $charity_id) {
        $sql = "INSERT INTO user (email, password, charity_id, type_id) VALUES (:username, :password, :charity_id, :type_id)";
        $params = [":username" => $username, ":password" => $password, ":charity_id" => $type_id, ":type_id" => $charity_id];
        $result = $this->getDatabase()->executeSQL($sql, $params);
        $this->setResult($result);
    }

    /**
     * Removes a user from the User database using the
     * user's email
     *
     * @param $username string The username of the user
     */
    public function removeUser($username) {
        $sql = "DELETE FROM user WHERE email = :username";
        $params = [":username" => $username];
        $result = $this->getDatabase()->executeSQL($sql, $params);
        $this->setResult($result);
    }

    public function resetPassword($user_id, $password) {
        $sql = "UPDATE user SET password = :password WHERE id = :id";
        $params = [":id" => $user_id, ":password" => $password];
        $result = $this->getDatabase()->executeSQL($sql, $params);
        $this->setResult($result);
    }
}
