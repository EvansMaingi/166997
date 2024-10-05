<?php

require_once __DIR__ . '/../includes/dbConnection.php';  
require_once __DIR__ . '/../Forms/SignUpForm.php';       
require_once __DIR__ . '/../includes/constants.php';     
require_once __DIR__ . '/../Classes/DisplayUsers.php';   


$db = new dbConnection(DBTYPE, HOSTNAME, DBPORT, HOSTUSER, HOSTPASS, DBNAME);  
$conn = $db->getConnection();

// Handle form submission for user signup
$signUpForm = new SignUpForm($conn);  
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $signUpForm->handleFormSubmission();  
}

// Render the sign-up form (ensure the renderForm method exists in SignUpForm)
$signUpForm->renderForm();

// Display all users in a table
$displayUsers = new DisplayUsers($conn);  // Create an instance of DisplayUsers and pass the connection
$displayUsers->displayUsersTable();  // Display users logic (ensure this method exists in DisplayUsers)
?>
