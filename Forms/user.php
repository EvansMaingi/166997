<?php
require_once '../includes/dbConnection.php';

class User {
    private $fullname;
    private $email;
    private $username;
    private $password;
    private $genderId;
    private $roleId;
    private $connection;

    public function __construct($fullname, $email, $username, $password, $genderId, $roleId) {
        $this->fullname = $fullname;
        $this->email = $email;
        $this->username = $username;
        $this->password = password_hash($password, PASSWORD_DEFAULT); // Hashing password
        $this->genderId = $genderId;
        $this->roleId = $roleId;

        // Establish database connection
        $db = new dbConnection();
        $this->connection = $db->getConnection();
    }

    // Method to save the user data
    public function saveUser() {
        try {
            $sql = "INSERT INTO users (fullname, email, username, password, genderId, roleId) 
                    VALUES (:fullname, :email, :username, :password, :genderId, :roleId)";
            $stmt = $this->connection->prepare($sql);

            // Binding parameters
            $stmt->bindParam(':fullname', $this->fullname);
            $stmt->bindParam(':email', $this->email);
            $stmt->bindParam(':username', $this->username);
            $stmt->bindParam(':password', $this->password);
            $stmt->bindParam(':genderId', $this->genderId);
            $stmt->bindParam(':roleId', $this->roleId);

            $stmt->execute();
            echo "User registered successfully!";
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
}
?>
