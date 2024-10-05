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
?>
