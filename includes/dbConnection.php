<?php
class dbConnection {
    private $connection;

    public function __construct() {
        $dsn = 'mysql:host=127.0.0.1:3307;dbname=ics_e';
        $username = 'root';
        $password = 'evoke@123';
        try {
            $this->connection = new PDO($dsn, $username, $password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }

    public function getConnection() {
        return $this->connection;
    }
}
?>
