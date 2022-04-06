<?php

/// USER LOGIN ///

if (isset($_POST["user_login_button"])){
    
    $userName = $_POST["user_name"];
    $userPassword = $_POST["user_password"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    loginUser($conn, $userName, $userPassword);
    
}

else {
    header("location: ../index.php");
    exit();
}