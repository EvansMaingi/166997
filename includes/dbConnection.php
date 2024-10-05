<?php

require_once __DIR__ . '/constants.php';  

class dbConnection {
    private $conn;

    
    public function __construct($dbType, $hostName, $dbPort, $hostUser, $hostPass, $dbName) {
        try {
            
            $dsn = "$dbType:host=$hostName;port=$dbPort;dbname=$dbName";
            
            $this->conn = new PDO($dsn, $hostUser, $hostPass);
            
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            
            echo "Connection failed: " . $e->getMessage();
            exit;
        }
    }

    // Method to get the connection for other operations
    public function getConnection() {
        return $this->conn;
    }
}
