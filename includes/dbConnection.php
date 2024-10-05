<?php
// Ensure the necessary constants are included
require "includes/constants.php";

class MyDbConnection {
    private $conn;

    
    public function __construct() {
        try {
            
            $dsn = DBTYPE . ":host=" . HOSTNAME . ";port=" . DBPORT . ";dbname=" . DBNAME;
            
            $this->conn = new PDO($dsn, HOSTUSER, HOSTPASS);
            
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            // Handle connection errors
            echo "Connection failed: " . $e->getMessage();
            exit;
        }
    }

    
    public function getConnection() {
        return $this->conn;
    }

    
    public function insertData($table, $data) {
        // Build the query
        $columns = implode(", ", array_keys($data));
        $placeholders = ":" . implode(", :", array_keys($data));
        
        $sql = "INSERT INTO $table ($columns) VALUES ($placeholders)";
        
        
        $stmt = $this->conn->prepare($sql);
        
    
        $stmt->execute($data);
    }
}
