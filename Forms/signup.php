<?php
require_once "../includes/dbConnection.php";
require_once "../Forms/SignUpForm.php";
require_once "../includes/constants.php";
require_once "../Forms/display_users.php";

// Establish database connection
$db = new dbConnection(DBTYPE, HOSTNAME, DBPORT, HOSTUSER, HOSTPASS, DBNAME);
$conn = $db->getConnection();


$signUpForm = new SignUpForm($conn);
$signUpForm->renderForm();


$signUpForm->handleFormSubmission();
?>
