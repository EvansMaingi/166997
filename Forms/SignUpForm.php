<?php
class SignUpForm {
    private $conn;

    public function __construct($dbConn) {
        $this->conn = $dbConn;
    }

    
    public function renderForm() {
        echo '
        <div class="container mt-5">
            <h2>Sign Up</h2>
            <form action="" method="POST">
                <div class="form-group">
                    <label for="fullname">Full Name:</label>
                    <input type="text" class="form-control" id="fullname" name="fullname" required>
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>

                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>

                <div class="form-group">
                    <label for="genderId">Gender:</label>
                    <select class="form-control" id="genderId" name="genderId" required>
                        <option value="" disabled selected>Select your gender</option>
                        <option value="1">Female</option>
                        <option value="2">Male</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="roleId">Role:</label>
                    <select class="form-control" id="roleId" name="roleId" required>
                        <option value="" disabled selected>Select your role</option>
                        <option value="1">Client</option>
                        <option value="2">Admin</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Sign Up</button>
            </form>
        </div>';
    }

    // Handles the form submission and registers the user
    public function handleFormSubmission() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $fullname = $_POST['fullname'];
            $email = $_POST['email'];
            $username = $_POST['username'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT); 
            $genderId = $_POST['genderId'];
            $roleId = $_POST['roleId'];

            // Check if the email already exists
            $stmt = $this->conn->prepare("SELECT COUNT(*) FROM users WHERE email = ?");
            $stmt->execute([$email]);
            $emailExists = $stmt->fetchColumn();

            if ($emailExists) {
                echo "<div class='alert alert-danger'>Error: Email already exists. Please use a different email.</div>";
            } else {
                // Insert into the database
                $stmt = $this->conn->prepare("INSERT INTO users (fullname, email, username, password, gender_id, role_id) VALUES (?, ?, ?, ?, ?, ?)");
                $stmt->execute([$fullname, $email, $username, $password, $genderId, $roleId]);

                echo "<div class='alert alert-success'>User registered successfully!</div>";
            }
        }
    }
}
?>
