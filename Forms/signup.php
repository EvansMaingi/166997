<?php
require_once "../includes/dbConnection.php";
require_once "../Forms/SignUpForm.php";
require_once "../includes/constants.php";
require_once "../Classes/DisplayUsers.php";

// Establish a database connection
$db = new dbConnection(DBTYPE, HOSTNAME, DBPORT, HOSTUSER, HOSTPASS, DBNAME);
$conn = $db->getConnection();

// Handle form submission
$signUpForm = new SignUpForm($conn);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $signUpForm->handleFormSubmission();
}

// Render the form
$signUpForm->renderForm();

// Display all users in a table
$displayUsers = new DisplayUsers($conn);
$displayUsers->displayUsersTable();
?>
