<!-- ADMIN HOME PAGE -->
<?php
    session_start();

#### check to make sure user is logged in ####

    if(isset($_SESSION["adminID"])){
    }
    else{
            header("location: admin_login_page.php");
        exit();
        }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Home Page</title>
    <link rel="stylesheet" href="css/main.css">
</head>

<body>

    <div class="admin_home_page_card">
        <div class="admin_home_page_main">

            <h3>Admin Home Page</h3>

            <a href="admin_user.php">User Details</a>
            <br>
            <br>
            <a href="admin_email.php">Email Notification Details</a>
            <br>
            <br>
            <a href="admin_details.php">Admin Details</a>
            <br>
            <br>
            <a href="includes/logout.inc.php">Logout</a>

        </div>
    </div>

</body>

</html>