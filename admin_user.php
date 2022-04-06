<!-- THIS IS THE ADMIN PAGE TO ADD A NEW USER TO THE DATABASE -->
<?php
    session_start();

#### check to make sure user is logged in ####

    if(isset($_SESSION["adminID"])){
    }
    else{
            header("location: admin_login_page.php");
        exit();
        }
        include_once 'includes/db_conn_functions.inc.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details</title>
    <link rel="stylesheet" href="css/main.css">
</head>

<body>

    <div class="admin_user_card">
        <div class="admin_user_main">

            <h3>Add New User</h3>

            <form action="includes/admin_user.inc.php" method="post" autocomplete="off">

                <div class="txt_field">
                    <label>New Username</label><br>
                    <input type="text" required name="new_user_name"><br>
                </div>
                <br>
                <div class="txt_field">
                    <label>New Password</label><br>
                    <input type="password" required name="new_user_password"><br>
                </div>
                <br>
                <!-- ERROR CHECKING FOR USERNAME IS ALREADY TAKEN -->

                <?php
                    if (isset($_GET["error"])){
                        if($_GET["error"] == "Username Taken"){
                            echo "<p>Username already exists.</p>";
                        }
                        if($_GET["error"] == "Invalid Username"){
                            echo "<p>Invalid Username.</p>";
                        }
                    }
                    ?>

                <div class="add_new_user_button">
                    <button type="submit" name="add_new_user_button">Add User</button>
                </div>

                <h3>Current Users</h3>

                <table border="5" cellpadding="5" class="view_all_users_table">
                    <tr>
                        <th>User Name</th>
                        <th>Delete User</th>

                        <?php
                        viewAll($conn, $dbName);
                    ?>

                    </tr>
                </table>

                <br>
                <div class="go_home_button">
                    <a href="admin_home_page.php">HOME</a>
                </div>

            </form>
        </div>
    </div>

</body>

</html>