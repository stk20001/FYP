<!-- Admin page - view - remove - add new admin accounts -->
<?php
    session_start();

#### Session check ####

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
    <title>Admin Details</title>
    <link rel="stylesheet" href="css/main.css">
</head>

<body>

    <div class="admin_details_card">
        <div class="admin_details_main">

            <h3>Add New Admin Details</h3>

            <form action="includes/admin_add_admin.inc.php" method="post" autocomplete="off">

                <div class="txt_field">
                    <label>New Admin Name</label><br>
                    <input type="text" required name="new_admin_name"><br>
                </div>
                <br>
                <div class="txt_field">
                    <label>New Admin Password</label><br>
                    <input type="password" required name="new_admin_password"><br>
                </div>
                <br>
                <div class="add_new_admin_button">
                    <button type="submit" name="add_new_admin_button">Add Admin Details</button>
                </div>
                <h3>Current Admin Details</h3>
                <h3>One account must always be present.</h3>
                <table border="5" cellpadding="5" class="view_admin_details_table">
                    <tr>
                        <th>Admin Name</th>
                        <th>Delete Admin Account</th>

                        <?php
                        viewAdmin($conn, $dbName);
                    ?>

                    </tr>
                </table>
                <br>
                <div class="go_home_button">
                    <a href="admin_home_page.php">HOME</a>
                </div>

                <!-- Error checking for account names -->

                <?php

                if (isset($_GET["error"])){

                    if($_GET["error"] == "Admin Name Already Exists"){

                        echo "<p>Admin Name Already Exists.</p>";

                    }

                    if($_GET["error"] == "Invalid Username"){

                        echo "<p>Invalid Username.</p>";

                    }
                }

                ?>

            </form>

        </div>
    </div>
</body>

</html>