<!-- THIS IS THE USER LOGIN PAGE THIS IS THE HOME PAGE -->
<?php
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/main.css">
</head>

<body>

    <div class="main_login_page">

        <div class="main_login_card">

            <h3>Please Login</h3>

            <form action="includes/index.inc.php" method="post" autocomplete="off">

                <div class="txt_field">
                    <label>Username</label><br>
                    <input type="text" required name="user_name"><br>
                </div>
                <br>
                <div class="txt_field">
                    <label>Password</label><br>
                    <input type="password" required name="user_password"><br>
                </div>
                <br>

                <div class="user_login_button">
                    <button type="submit" name="user_login_button">Login</button>
                </div>
                <br>

                <div>
                    <a href="admin_login_page.php">ADMIN</a>
                </div>

                <!-- ERROR CHECKING FOR INCORECT USERNAME OR PASSWORD -->

                <?php

                if (isset($_GET["error"])){

                    if($_GET["error"] == "wronglogindetails"){

                        echo "<p>Wrong Username or Password.</p>";

                    }
                }

                ?>

            </form>

        </div>

    </div>

</body>

</html>