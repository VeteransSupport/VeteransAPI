<?php
namespace src\gateways;

use src\database\Database;

/**
 * This class sits between the Controller and the
 * Database and houses the specific SQL queries
 * needed for interacting with the database.
 *
 * @author Pervaiz Ahmad w18014333
 */
abstract class Gateway {

    private $database;
    private $result;

    /**
     * Sets the database for the application with the
     * path to the SQLite database file.
     *
     * @param string $database The database file path
     */
    protected function setDatabase($database) {
        $this->database = new Database($database);
    }

    /**
     * Returns the database set in the gateway
     * for the application
     *
     * @return Database The database object
     */
    protected function getDatabase() {
        return $this->database;
    }

    /**
     * Sets the results of API endpoint called
     *
     * @param string $result The resultant string from the API endpoint
     */
    public function setResult($result) {
        $this->result = $result;
    }

    /**
     * Returns the results of API endpoint called
     *
     * @return string The resultant string from the API endpoint
     */
    public function getResult() {
        return $this->result;
    }
}
