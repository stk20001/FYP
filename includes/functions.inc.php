<?php

//  //  //  //  THIS IS THE ADMIN ADD USER TO DATABASE PAGE //  //  //  //

// Search the user name input for invalid symbols.
// Built in search function in PHP. 

function invalid_user_name($userName) {
    
    $result;
    
    if(!preg_match("/^[a-zA-Z0-9]*$/", $userName)){
        $result = true;
    }
    
    else {
        $result = false;
    }
    
    return $result;
}

    // NEW USER ADDED HANDELING //

// Check to see if the user name is already taken.
// Prevent code being injected into the database from text field input.

function user_name_taken($conn, $userName) {
    $sql = "SELECT * FROM users WHERE userName = ?;";

    $stmt = mysqli_stmt_init($conn);

    // Checking to see if the name is NOT there.
    if(!mysqli_stmt_prepare($stmt, $sql)){ 
    header("location: ../index.php?error=Input statement failed");
    exit();
    }
    
    mysqli_stmt_bind_param($stmt, "s", $userName);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($resultData)){
        return $row;
    }
    else{
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

    // ADD THE USER TO THE DATABASE // 

function createUser($conn, $userName, $userPassword) {
    $sql = "INSERT INTO users (userName, userPassword) VALUES (?, ?);";
    
     $stmt = mysqli_stmt_init($conn);
    
    // Checking to see if the name is NOT there.
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../index.php?error=Input statement failed");
        exit();
        }
        
        // Hash the password before adding to the database.
        $hashedPassword = password_hash($userPassword, PASSWORD_DEFAULT);
        
        mysqli_stmt_bind_param($stmt, "ss", $userName, $hashedPassword);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
 
        header("location: ../user_added_confirmed.php?error=none");
        exit();
}

//////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////

//  //  //  //  THIS IS USER LOGIN TO THE USER HOME PAGE //  //  //  //

function loginUser($conn, $userName, $userPassword){
    $user_name_taken = user_name_taken($conn, $userName);

    if($user_name_taken == false){
        header("location: ../index.php?error=wronglogindetails");
        exit();
    }

    $passHashed = $user_name_taken["userPassword"];
    $checkPass = password_verify($userPassword, $passHashed);

    if($checkPass == false){
        header("location: ../index.php?error=wronglogindetails");
        exit();
    }

    // START SESSION
    else if ($passHashed == true){
        session_start();

        $_SESSION["userID"] = $user_name_taken["userName"];

        header("location: ../user_home_page.php");
        exit();

    }
}

//////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////

    // ADMIN LOGIN TO ADMIN PAGE //

function admin_name_taken($conn, $admin_userName) {
    $sql = "SELECT * FROM admindetails WHERE adminName = ?;";

    $stmt = mysqli_stmt_init($conn);

    // Checking to see if the name is NOT there.
    if(!mysqli_stmt_prepare($stmt, $sql)){ 
        header("location: ../admin_login_page.php?error=Input statement failed");
        exit();
        }
    
    mysqli_stmt_bind_param($stmt, "s", $admin_userName);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($resultData)){
        return $row;
    }
    else{
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

function loginAdmin($conn, $admin_userName, $admin_userPassword){
    $admin_name_taken = admin_name_taken($conn, $admin_userName);

    if($admin_name_taken == false){
        header("location: ../admin_login_page.php?error=wronglogindetails");
        exit();
    }

    $passHashed = $admin_name_taken["adminPassword"];
    $checkPass = password_verify($admin_userPassword, $passHashed);

    if($checkPass == false){
        header("location: ../admin_login_page.php?error=wronglogindetails");
        exit();
    }

    // START SESSION
    else if ($passHashed == true){
        session_start();

        $_SESSION["adminID"] = $admin_name_taken["adminName"];

        header("location: ../admin_home_page.php?");
        exit();

    }
}


//////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////

    // VIEW TABLE OF USERS IN USERS - ADMIN //

    function viewAll($conn, $dbName){
        
        $sql = "SELECT * FROM users;";

        $result = mysqli_query($conn, $sql);

        $resultCheck = mysqli_num_rows($result);

        if ($resultCheck > 0){
            while($row = mysqli_fetch_assoc($result)){                
                echo "<tr><td> ".$row['userName']." </td>";
                echo "<td> <a href = 'admin_user.php?userName=" .$row['userName']." 'class = 'delete_user_button'> Delete </td></tr>";
           }
        }
        
        else{
            echo "NO USERS";
        }
    }

//////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////

    // DELETE USERS IN VIEW/REMOVE USERS - ADMIN //

if (isset($_GET['userName'])){
    $userIdDelete = $_GET['userName'];
    $delete = mysqli_query($conn, "DELETE FROM `users` WHERE `userName` = '$userIdDelete'");

}

//////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////

    // ADD EMAILS TO THE DATABASE // 

    function invalidGmail($gmailAddress) {
    
        $result;
        
        if(!filter_var($gmailAddress, FILTER_VALIDATE_EMAIL)){
            $result = true;
        }
        
        else {
            $result = false;
        }
        
        return $result;
    }


    function invalidEmail($userEmailAddress) {
    
        $result;
        
        if(!filter_var($userEmailAddress, FILTER_VALIDATE_EMAIL)){
            $result = true;
        }
        
        else {
            $result = false;
        }
        
        return $result;
    }


    function emailExists($conn, $gmailAddress, $userEmailAddress) {
        $sql = "SELECT * FROM email_alert WHERE gmail_address = ? OR user_address = ?;";

        $stmt = mysqli_stmt_init($conn);

        // Checking to see if the name is NOT there.
        if(!mysqli_stmt_prepare($stmt, $sql)){ 
        header("location: ../admin_email.php?error=1st Input statement failed");
        exit();
        }
        
        mysqli_stmt_bind_param($stmt, "ss", $gmailAddress, $userEmailAddress);
        mysqli_stmt_execute($stmt);

        $resultData = mysqli_stmt_get_result($stmt);

        if($row = mysqli_fetch_assoc($resultData)){
            return $row;
        }
        else{
            $result = false;
            return $result;
        }

        mysqli_stmt_close($stmt);
    }

    function addemail($conn, $gmailAddress, $userEmailAddress, $gmailPassword) {
        $sql = "INSERT INTO email_alert (gmail_address, user_address, gmail_address_password) VALUES (?, ?, ?);";
        
         $stmt = mysqli_stmt_init($conn);
        
        // Checking to see if the name is NOT there.
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("location: ../index.php?error=2nd Input statement failed");
            exit();
            }
            
            // Hash the password before adding to the database.
            // Not used as not possible to dehash with python in order to use.
            // $gmailhashedPassword = password_hash($gmailPassword, PASSWORD_DEFAULT);
            
            mysqli_stmt_bind_param($stmt, "sss", $gmailAddress, $userEmailAddress, $gmailPassword);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_close($stmt);
     
            header("location: ../email_added_confirmed.php?error=none");
            exit();
    }

//////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////

    // VIEW TABLE OF EMAILS IN VIEW/CHANGE EMAILS - ADMIN //

    function viewAllEmials($conn, $dbName){
        
        $sql = "SELECT * FROM email_alert;";

        $result = mysqli_query($conn, $sql);

        $resultCheck = mysqli_num_rows($result);

        if ($resultCheck > 0){
            while($row = mysqli_fetch_assoc($result)){                
                echo "<tr><td> ".$row['gmail_address']." </td>";
                echo "<td> ".$row['user_address']." </td>";
                echo "<td> <a href = 'admin_email.php?gmail_address=" .$row['gmail_address']."  'class = 'delete_email_button'> Delete </td></tr>";
           }
        }
        
        else{
            echo "NO EMAILS ADDRESSES STORED";
        }
    }

//////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////

    // DELETE USERS IN VIEW/REMOVE USERS - ADMIN //

if (isset($_GET['gmail_address'])){
    $emailDelete = $_GET['gmail_address'];
    $delete = mysqli_query($conn, "DELETE FROM `email_alert` WHERE `gmail_address` = '$emailDelete'");

}

//////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////

    // VIEW TABLE OF ADMIN IN VIEW/CHANGE ADMIN //

    function viewAdmin($conn, $dbName){
        
        $sql = "SELECT * FROM admindetails;";

        $result = mysqli_query($conn, $sql);

        $resultCheck = mysqli_num_rows($result);

        if ($resultCheck > 0){
            while($row = mysqli_fetch_assoc($result)){                
                echo "<tr><td> ".$row['adminName']." </td>";
                echo "<td> <a href = 'admin_details.php?adminName=" .$row['adminName']." 'class = 'delete_admin_button'> Delete </td></tr>";
           }
        }
        
        else{
            echo "NO USERS";
        }
    }

//////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////

//  //  //  //  THIS IS THE ADMIN ADD ADMIN TO DATABASE PAGE //  //  //  //

// Search the user name input for invalid symbols.
// Built in search function in PHP. 

function invalid_admin_name($adminName) {
    
    $result;
    
    if(!preg_match("/^[a-zA-Z0-9]*$/", $adminName)){
        $result = true;
    }
    
    else {
        $result = false;
    }
    
    return $result;
}

    // NEW ADMIN ACCOUNT HANDELING //

// Check to see if the user name is already taken.
// Prevent code being injected into the database from text field input.

function admins_name_taken($conn, $adminName) {
    $sql = "SELECT * FROM admindetails WHERE adminName = ?;";

    $stmt = mysqli_stmt_init($conn);

    // Checking to see if the name is NOT there.
    if(!mysqli_stmt_prepare($stmt, $sql)){ 
    header("location: ../index.php?error=Input statement failed");
    exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $adminName);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($resultData)){
        return $row;
    }
    else{
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}

    // ADD NEW ADMIN TO THE DATABASE // 

function createAdmin($conn, $adminName, $adminPassword) {
    $sql = "INSERT INTO admindetails (adminName, adminPassword) VALUES (?, ?);";
    
     $stmt = mysqli_stmt_init($conn);
    
    // Checking to see if the name is NOT there.
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../index.php?error=Input statement failed");
        exit();
        }
        
        // Hash the password before adding to the database.
        $hashedadminPassword = password_hash($adminPassword, PASSWORD_DEFAULT);
        
        mysqli_stmt_bind_param($stmt, "ss", $adminName, $hashedadminPassword);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
 
        header("location: ../admin_added_confirmed.php?error=none");
        exit();
}

//////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////

    // DELETE ADMIN IN VIEW/CHANGE ADMIN //

    if (isset($_GET['adminName'])){

        $query = "SELECT adminID FROM admindetails ORDER BY adminID";
        $query_run = mysqli_query($conn, $query);

        $row = mysqli_num_rows($query_run);

        if ($row == 1) {
        echo "One Admin Account Must Remain.";
    }
        else{
            $adminDelete = $_GET['adminName'];
            $delete = mysqli_query($conn, "DELETE FROM `admindetails` WHERE `adminName` = '$adminDelete'");
        }
    
    }
    
//////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////