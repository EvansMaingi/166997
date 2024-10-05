<?php
class SignUpForm {
    private $conn;

    public function __construct($dbConn) {
        $this->conn = $dbConn;
    }

    
    public function renderForm() {
        echo '
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-primary text-white text-center">
                            <h2>Sign Up</h2>
                        </div>
                        <div class="card-body">
                            <form action="" method="POST">
                                <div class="mb-3">
                                    <label for="fullname" class="form-label">Full Name:</label>
                                    <input type="text" class="form-control" id="fullname" name="fullname" required>
                                </div>

                                <div class="mb-3">
                                    <label for="email" class="form-label">Email:</label>
                                    <input type="email" class="form-control" id="email" name="email" required>
                                </div>

                                <div class="mb-3">
                                    <label for="username" class="form-label">Username:</label>
                                    <input type="text" class="form-control" id="username" name="username" required>
                                </div>

                                <div class="mb-3">
                                    <label for="password" class="form-label">Password:</label>
                                    <input type="password" class="form-control" id="password" name="password" required>
                                </div>

                                <div class="mb-3">
                                    <label for="genderId" class="form-label">Gender:</label>
                                    <select class="form-control" id="genderId" name="genderId" required>
                                        <option value="" disabled selected>Select your gender</option>
                                        <option value="1">Female</option>
                                        <option value="2">Male</option>
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label for="roleId" class="form-label">Role:</label>
                                    <select class="form-control" id="roleId" name="roleId" required>
                                        <option value="" disabled selected>Select your role</option>
                                        <option value="1">Client</option>
                                        <option value="2">Admin</option>
                                    </select>
                                </div>

                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary btn-block">Sign Up</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>';
    }

    // Handle the form submission and register the user
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
