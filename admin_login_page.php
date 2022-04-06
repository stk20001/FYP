<!-- THIS IS THE ADMIN LOGIN PAGE TO THE ADMIN SECTION -->
<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="css/main.css">
</head>

<body>

    <div class="admin_login_page">

        <div class="admin_login_card">

            <h3>Admin Please Login</h3>

            <form action="includes/admin_login_page.inc.php" method="post" autocomplete="off">

                <div class="txt_field">
                    <label>Admin Username</label><br>
                    <input type="text" required name="admin_user_name"><br>
                </div>

                <br>
                <div class="txt_field">
                    <label>Admin Password</label><br>
                    <input type="password" required name="admin_user_password"><br>
                </div>

                <br>
                <div class="admin_login_button">
                    <button type="submit" name="admin_login_button">Login</button>
                </div>

                <br>
                <div class="user_login_page">
                    <a href="index.php">HOME</a>
                </div>

                <!-- ERROR CHECKING FOR INCORECT USERNAME OR PASSWORD -->

                <?php

                if (isset($_GET["error"])){

                    if($_GET["error"] == "wronglogindetails"){

                        echo "<p>Wrong Username Or Password.</p>";

                    }
                }

                ?>

            </form>

        </div>

    </div>

</body>

</html>