<!-- Admin page to view - add - remove contact emails -->
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
    <title>View Email Details</title>
    <link rel="stylesheet" href="css/main.css">
</head>

<body>

    <div class="admin_email_card">
        <div class="admin_email_main">

            <h3>Add New Email Details</h3>

            <form action="includes/admin_email.inc.php" method="post" autocomplete="off">

                <div class="txt_field">
                    <label>New Gmail Notification Account</label><br>
                    <input type="text" required name="alert_gmail_address"><br>
                </div>
                <br>
                <div class="txt_field">
                    <label>New Client Email Account</label><br>
                    <input type="text" required name="user_email_address"><br>
                </div>
                <br>
                <div class="txt_field">
                    <label>Add Gmail APP Password</label><br>
                    <input type="password" required name="gmail_password"><br>
                </div>
                <br>

                <!-- Error checking for email details-->

                <?php
                    if (isset($_GET["error"])){

                        if($_GET["error"] == "adminemailexists"){

                            echo "<p>Email already exists.</p>";

                        }
                    }

                    ?>
                <div class="admin_email">
                    <button type="submit" name="admin_email_button">Add Email Details</button>
                </div>

                <h3>Current Email Details</h3>

                <table border="5" cellpadding="5" class="view_all_emails_table">
                    <tr>
                        <th>Gmail Address</th>
                        <th>Client Email</th>
                        <th>Delete Addresses</th>

                        <?php
                    
                    viewAllEmials($conn, $dbName);
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