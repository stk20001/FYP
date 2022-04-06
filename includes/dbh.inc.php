<?php

$servreName = "localhost";
$dbUsername = "root";
$dbPassword = "4321";
$dbName = "sec_db";

$conn = mysqli_connect($servreName, $dbUsername, $dbPassword, $dbName);

if(!$conn) {
    die("ERROR IN CONNECTION: " . mysqli_connect_error());
}