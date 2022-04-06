<?php

/// ADMIN ADD NEW EMAILS TO THE DATABASE ///

// If the user did not use the correct 
// way of arriving to the page. Must have 
// used the Submit/Login button. Returns user to 
// correct page if they used the wrong link.

if (isset($_POST["admin_email_button"])){
   
    $gmailAddress = $_POST["alert_gmail_address"];
    $userEmailAddress = $_POST["user_email_address"];
    $gmailPassword = $_POST["gmail_password"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    if(invalidGmail($gmailAddress) !== false){
        header("location: ../admin_email.php?error=invalidgmail");
        exit();
    }

    if(invalidEmail($userEmailAddress) !== false){
        header("location: ../admin_email.php?error=invalidemail");
        exit();
    }

    if(emailExists($conn, $gmailAddress, $userEmailAddress) !== false){
        header("location: ../admin_email.php?error=adminemailexists");
        exit();
    }

    // Add new emails to database.
    addemail($conn, $gmailAddress, $userEmailAddress, $gmailPassword);


}
    else {
       header("location: ../admin_email.php");
        exit();
    }
