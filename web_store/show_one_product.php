<?php
session_start();
include_once "class_database.php";
include_once "functions.php";
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
    <?php
    echo " <div class ='main_container>'";
    echo "<div class='content'>";
    create_header( ['home','products','cart','login','logout'] );
    if ( isset($_GET['action']) && $_GET['action'] =='show_product' ){
        $barcode = $_GET['barcode'];
        $product = $base->one_product($barcode);
        show_one_product ( $product );
    }

  
    echo "</div>";
    create_footer( ['home','products','cart','login','logout',] );
    echo "</div>";
    
?>
    
</body>
</html>