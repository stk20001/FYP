<?php

/// ADMIN LOGIN ///

if (isset($_POST["admin_login_button"])){
    
    $admin_userName = $_POST["admin_user_name"];
    $admin_userPassword = $_POST["admin_user_password"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    loginAdmin($conn, $admin_userName, $admin_userPassword);
    
}

else {
    header("location: ../admin_login_page.php");
    exit();
}