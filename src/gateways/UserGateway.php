<?php
namespace src\gateways;

/**
 * This gateway queries the USER database for the
 * password associated with an email and returns
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
     * Finds the password using the user's email.
     *
     * @param $email string The user's email
     */
    public function findPassword($email) {
        $sql = "Select * from user where email = :email";
        $params = [":email" => $email];
        $result = $this->getDatabase()->executeSQL($sql, $params);
        $this->setResult($result);
    }

    /**
     * Adds a new user to the User database using the
     * user's email and password
     *
     * @param $email string The email of the new user
     * @param $password string The password of the new user
     */
    public function addUser($email, $password) {
        $sql = "INSERT INTO user (email, password) VALUES (:email, :password)";
        $params = [":email" => $email, ":password" => $password];
        $result = $this->getDatabase()->executeSQL($sql, $params);
        $this->setResult($result);
    }

    /**
     * Removes a user from the User database using the
     * user's email
     *
     * @param $email string The email of the user
     */
    public function removeUser($email) {
        $sql = "DELETE FROM user WHERE email = :email";
        $params = [":email" => $email];
        $result = $this->getDatabase()->executeSQL($sql, $params);
        $this->setResult($result);
    }
}
