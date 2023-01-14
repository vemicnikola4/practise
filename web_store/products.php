<?php
session_start();
include "class_database.php";
include "functions.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
</head>
<body>
    <div class='main_contaner' id='products_php_main_container'>
    <?php
    create_header( ['home','products','login','logout'] );
    echo "<div class='content'>";
    if ( isset($_SESSION['user'])){
        echo "<h1>HELLO USER YOU ARE WELCOME</h1>";
    }else{
        echo "<div class='link'><a href='login.php?action=login'>LOG IN</a></div>";
        echo "<div class='link'><a href='index.php?action=login'>SING UP</a></div>";

        $all_products = $base -> all_products();

        show_all_products($all_products);

    }
    
    create_footer( ['home','products','login','logout',] );
    ?>
    </div>
    </div>
</body>
</html>