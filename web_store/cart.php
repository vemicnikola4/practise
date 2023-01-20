<?php
session_start();
include 'functions.php';
include 'class_database.php';
include 'class_cart.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div class='main_container' id='main_container_cart'>
        <div class='content' id='content_cart'>
        <?php
        if ( !isset ($_SESSION['user']) && !isset($_COOKIE['user'])){
            echo "<h3></h3>";
            echo "<a href='index.php'SING UP></a>";
            echo "<a href='login.php'>LOGIN</a>";
        }
        create_header( ['home','products','login','logout'] );
       
        $cart -> show_cart();
        
        ?>

        </div>
    </div>
    <?php
        create_footer( ['home','products','login','logout'] );

        ?>

</body>
</html>