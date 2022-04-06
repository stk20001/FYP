<?php
    session_start();

#### check to make sure user is logged in ####

    if(isset($_SESSION["userID"])){
    }
    else{
            header("location: index.php");
            exit();
            }
    
#### functions for light ####

    if (isset($_POST['on'])){
        echo shell_exec("python /var/www/html/FYP/light_on.py");
        }

    if (isset($_POST['off'])){
        echo shell_exec("python /var/www/html/FYP/light_off.py");
        }

#### function for unlocking door ####

    if (isset($_POST['open'])){
        echo shell_exec("python /var/www/html/FYP/open_door.py");
    }

?>

<br>
<br>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="css/main.css">
    <script src="functions.js"></script>

</head>

<body>

    <div class="user_home_page_card">
        <div class="main">

            <form class="uhp_b1" action="<?=$_SERVER['PHP_SELF']?>" method="post"><input name="on" type="submit"
                    value="Light On">
                <form class="uhp_b2" action="<?=$_SERVER['PHP_SELF']?>" method="post"><input name="off" type="submit"
                        value="Light Off"></form>

                <!-- FOR EXTERNAL CONNECTIONS -->
                <!-- CHANGE ADDRESS TO ftythomas.hopto.org:8000/index.html -->
                <form>
                    <button class="uhp_b3" type="button"
                        onclick="parent.location='http://fypthomas.hopto.org:8000/index.html'">Front Door
                        Camera</button>
                </form>

                <form class="uhp_4" onclick="door_check()" action="<?=$_SERVER['PHP_SELF']?>" method="post"><input
                        name="open" type="submit" value="Open Front Door"></form>

                <p><a class="button_logout" href="includes/logout.inc.php">Logout</a></p>
        </div>
    </div>
   
</body>

</html>