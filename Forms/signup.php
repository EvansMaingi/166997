<?php
require_once "../includes/dbConnection.php";
require_once "../Forms/SignUpForm.php";
require_once "../includes/constants.php";

// Establish database connection
$db = new dbConnection(DBTYPE, HOSTNAME, DBPORT, HOSTUSER, HOSTPASS, DBNAME);
$conn = $db->getConnection();

// Create and render the sign-up form
$signUpForm = new SignUpForm($conn);
$signUpForm->renderForm();

// Handle form submission
$signUpForm->handleFormSubmission();
?>
