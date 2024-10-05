<?php

class DisplayUsers {
    private $conn;

    public function __construct($dbConn) {
        $this->conn = $dbConn;
    }

    public function displayUsersTable() {
        
        $stmt = $this->conn->prepare("SELECT fullname, email, username, gender_id, role_id FROM users");
        $stmt->execute();

        
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);

        
        if ($users) {
            echo '
            <div class="container mt-5">
                <h2>Registered Users</h2>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Username</th>
                            <th>Gender</th>
                            <th>Role</th>
                        </tr>
                    </thead>
                    <tbody>';

            
            foreach ($users as $user) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($user['fullname']) . '</td>';
                echo '<td>' . htmlspecialchars($user['email']) . '</td>';
                echo '<td>' . htmlspecialchars($user['username']) . '</td>';
                echo '<td>' . ($user['gender_id'] == 1 ? 'Female' : 'Male') . '</td>';
                echo '<td>' . ($user['role_id'] == 1 ? 'Client' : 'Admin') . '</td>';
                echo '</tr>';
            }

            echo '
                    </tbody>
                </table>
            </div>';
        } else {
            
            echo '<div class="container mt-5"><p>No users found in the database.</p></div>';
        }
    }
}

require "DbConnection.php";  

$dbConn = new PDO('mysql:host=localhost;dbname=your_database_name', 'your_username', 'your_password');
$displayUsers = new DisplayUsers($dbConn);
$displayUsers->displayUsersTable();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>User List</title>
</head>
<body


