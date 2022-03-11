<?php
namespace src\database;

use PDO;

/**
 * The database class which stores the connection
 * to the application database. This database is
 * queried from at the API endpoints.
 *
 * @author Pervaiz Ahmad w18014333
 */
class Database {
    private $dbConnection;

    /**
     * Sets the database connection using the path
     * to the SQLite database file.
     *
     * @param string $dbName The file path to the
     *                       SQLite database file
     */
    public function __construct($dbName) {
        $this->setDbConnection($dbName);
    }

    /**
     * Sets the database connection
     *
     * @param string $dbName Database file path
     */
    private function setDbConnection($dbName) {
            $this->dbConnection = new PDO('sqlite:'.$dbName);
            $this->dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    /**
     * Executes the SQL query using prepared statements and
     * any the params if provided.
     *
     * @param string $sql       The sql query
     * @param string[] $params  The parameters to be executed
     * @return string           The results
     */
    public function executeSQL($sql, $params=[]) {
        $stmt = $this->dbConnection->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
