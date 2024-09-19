<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</html>

<?php


class SignUpForm {
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
                        <option value="0">Female</option>
                        <option value="1">Male</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="roleId">Role:</label>
                    <select class="form-control" id="roleId" name="roleId" required>
                        <option value="" disabled selected>Select your role</option>
                        <option value="0">Client</option>
                        <option value="1">Admin</option>
                        
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Sign Up</button>
            </form>
        </div>';
    }
}
?>
