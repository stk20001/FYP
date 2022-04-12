<?php

/// Add new general users to the database ///

// If the user did not use the correct 
// way of arriving to the page. Must have 
// used the Submit/Login button. Returns user to 
// correct page if they used the wrong link.

if (isset($_POST["add_new_user_button"])){
    
    $userName = $_POST["new_user_name"];
    $userPassword = $_POST["new_user_password"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    // Search the user name input for invalid symbols.
    // Calling functions from funstions.inc.php

    if(invalid_user_name($userName) !== false){
        header("location: ../admin_user.php?error=Invalid Username");
        exit();
    }
    
    if(user_name_taken($conn, $userName) !== false){
        header("location: ../admin_user.php?error=Username Taken");
        exit();
    }

    // Add new user to database.
    createUser($conn, $userName, $userPassword);

}
    else {
        header("location: ../admin_add_user.php");
        exit();
    }