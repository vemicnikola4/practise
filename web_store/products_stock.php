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
    <title>Document</title>
</head>
<body>
<div class='main_container'>
    <?php
    create_header( ['home','products','cart','login','logout'] );
    echo "<div class='content'>";
    if (isset( $_POST['action'] ) &&  $_POST['action']== 'show_products_in_stock'){
        $barcode =trim($_POST['barcode'], " ");
        if ( $barcode == 'all'){
            $all_products = $base->all_products();
            show_products_stocks($all_products);
        }else{
            $barcode =trim($_POST['barcode']," ");
            if ( $product =  $base->one_product($barcode) ){
                show_one_product_in_stocks($product);
            }else{
                echo "<a href='product_forms.php'>Barcode not found back to forms</a>";
            }            
        }

    }
  
    echo "</div>";
    echo "</div>";
    create_footer( ['home','products','cart','login','logout','product_forms'] );
    
    
    ?>
</body>
</html>