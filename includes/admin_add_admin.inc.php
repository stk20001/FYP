<?php

/// ADMIN ADD NEW ADMIN TO THE DATABASE ///

// If the user did not use the correct 
// way of arriving to the page. Must have 
// used the Submit/Login button. Returns user to 
// correct page if they used the wrong link.

if (isset($_POST["add_new_admin_button"])){
    
    $adminName = $_POST["new_admin_name"];
    $adminPassword = $_POST["new_admin_password"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    // Search the user name input for invalid symbols.
    // Calling functions from funstions.inc.php

    if(invalid_admin_name($adminName) !== false){
        header("location: ../admin_details.php?error=Invalid Username");
        exit();
    }
    
    if(admins_name_taken($conn, $adminName) !== false){
        header("location: ../admin_details.php?error=Admin Name Already Exists");
        exit();
    }

    // Add new user to database.
    createAdmin($conn, $adminName, $adminPassword);

}
    else {
        header("location: ../admin_details.php");
        exit();
    }