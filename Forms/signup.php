<?php

require_once __DIR__ . '/../includes/dbConnection.php';  
require_once __DIR__ . '/../Forms/SignUpForm.php';       
require_once __DIR__ . '/../includes/constants.php';     
require_once __DIR__ . '/../Forms/DisplayUsers.php';   


$db = new dbConnection(DBTYPE, HOSTNAME, DBPORT, HOSTUSER, HOSTPASS, DBNAME);  
$conn = $db->getConnection();

// Handle form submission for user signup
$signUpForm = new SignUpForm($conn);  
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $signUpForm->handleFormSubmission();  
}


$signUpForm->renderForm();


$displayUsers = new DisplayUsers($conn);  
$displayUsers->displayUsersTable();  
?>
