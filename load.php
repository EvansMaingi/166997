<?php


require "includes/constants.php"; 
require "includes/dbConnection.php";


function ClassAutoload($ClassName) {
    $directories = ["forms", "processes", "structure", "tables", "global", "store"];

    foreach ($directories as $dir) {
        
        $FileName = __DIR__ . DIRECTORY_SEPARATOR . $dir . DIRECTORY_SEPARATOR . $ClassName . '.php';

        
        if (file_exists($FileName) && is_readable($FileName)) {
            require_once $FileName;
        }
    }
}


spl_autoload_register('ClassAutoload');

// MyDbConnection class for connecting to the database
class MyDbConnection {
    private $conn;

    // Constructor to establish a database connection
    public function __construct() {
        try {
            // Fetch constants from the configuration
            $dsn = DBTYPE . ":host=" . HOSTNAME . ";port=" . DBPORT . ";dbname=" . DBNAME;
            // Create a new PDO instance
            $this->conn = new PDO($dsn, HOSTUSER, HOSTPASS);
            
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

    
    public function insertData($table, $data) {
        try {
            
            $columns = implode(", ", array_keys($data));
            $placeholders = ":" . implode(", :", array_keys($data));
            
            $sql = "INSERT INTO $table ($columns) VALUES ($placeholders)";
            
            
            $stmt = $this->conn->prepare($sql);
            
            
            $stmt->execute($data);
            echo "Data inserted successfully!";
        } catch (PDOException $e) {
            
            echo "Error inserting data: " . $e->getMessage();
        }
    }
}

// Creating instances of all classes (ensure these classes are defined in the autoload directories)
$ObjLayouts = new layouts();
$ObjMenus = new menus();
$ObjContents = new contents();

// Create a new database connection
$dbConn = new MyDbConnection(); // No need to pass constants here since it's fetched from constants.php
$conn = $dbConn->getConnection(); // Get the PDO connection object

// Sample data to insert (ensure this is sanitized and validated properly)
$data = [
    'username' => 'john_doe',       
    'email' => 'john@example.com',
    'password' => password_hash('securepassword', PASSWORD_DEFAULT) 
];


$dbConn->insertData('users', $data); 


$ObjLayouts->heading();
$ObjMenus->main_menu();
$ObjContents->about_content();
$ObjContents->sidebar();
$ObjLayouts->footer();

?>
