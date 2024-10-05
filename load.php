<?php

require "includes/constants.php";
require "includes/DbConnection.php";

// Autoloader function to load class files dynamically
function ClassAutoload($ClassName) {
    $directories = ["forms", "processes", "structure", "tables", "global", "store"];

    foreach ($directories as $dir) {
        // Create the full path to the file
        $FileName = __DIR__ . DIRECTORY_SEPARATOR . $dir . DIRECTORY_SEPARATOR . $ClassName . '.php';

        // Check if the file exists and is readable, then include it
        if (file_exists($FileName) && is_readable($FileName)) {
            require_once $FileName;
        }
    }
}

// Register the autoloader
spl_autoload_register('ClassAutoload');

// Database connection class using PDO
class Dbconnection {
    private $conn;

    // Constructor to establish a database connection
    public function __construct($dbType, $hostName, $dbPort, $hostUser, $hostPass, $dbName) {
        try {
            // Build the DSN (Data Source Name) string
            $dsn = "$dbType:host=$hostName;port=$dbPort;dbname=$dbName";
            // Create a new PDO instance
            $this->conn = new PDO($dsn, $hostUser, $hostPass);
            // Set error mode to exceptions
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            // Handle connection errors
            echo "Connection failed: " . $e->getMessage();
            exit;
        }
    }

    // Method to get the connection for other operations
    public function getConnection() {
        return $this->conn;
    }

    // Example method to insert data into a table
    public function insertData($table, $data) {
      
        $columns = implode(", ", array_keys($data));
        $placeholders = ":" . implode(", :", array_keys($data));
        
        $sql = "INSERT INTO $table ($columns) VALUES ($placeholders)";

   
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($data);
    }
}

// Creating instances of all classes 
$ObjLayouts = new layouts();
$ObjMenus = new menus();
$ObjContents = new contents();

// Create a new database connection
$conn = new dbConnection(DBTYPE, HOSTNAME, DBPORT, HOSTUSER, HOSTPASS, DBNAME);



$conn->insertData('users', $data);
