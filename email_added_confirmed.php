<!-- Confirm email added to the database -->
<?php
    session_start();

#### Session Check ####

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
    <title>Add New User</title>
    <link rel="stylesheet" href="css/main.css">
</head>

<body>

    <div class="confirm_admin_added_new_user">

        <div class="confirm_admin_added_new_user_card">

            <h3>New Email Details Added</h3>

            <div class="go_home_button">
                <a href="admin_home_page.php">ADMIN HOME PAGE</a>
            </div>
        </div>

    </div>

</body>

</html>