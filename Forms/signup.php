<?php

require_once 'SignUpForm.php';
require_once 'User.php';


$form = new SignUpForm();
$form->renderForm();




// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $genderId = $_POST['genderId'];
    $roleId = $_POST['roleId'];

    // Create a User object and save the user
    $user = new User($fullname, $email, $username, $password, $genderId, $roleId);
    $user->saveUser();
}
?>
