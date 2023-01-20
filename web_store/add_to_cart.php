<?php
session_start();
include 'functions.php';
include 'class_database.php';
include 'class_cart.php';

echo "<div class='main_container' id='main_container_add_to_cart'>";
create_header( ['home','products','login','logout'] );
echo "<div class='content'>";
if (isset( $_GET['action']) && $_GET['action'] == 'add_to_cart' ){
    $barcode = $_GET['barcode'];
    $quantity = 1;
    $all_products = $base -> all_products();
    for ( $i = 0; $i < count( $all_products ); $i++){
        if ( $barcode == $all_products[$i]['barcode']){
            $name = $all_products[$i]['name'];
            $price = $all_products[$i]['price'];
        }  
    }
    $cart -> add_item($barcode,$name,$price,$quantity);
    $cart -> show_cart();
    header ('Location:cart.php');
} 
if (isset( $_GET['action']) && $_GET['action'] == 'add_quantity' ){
    $barcode = $_GET['barcode'];
    $cart -> change_quantity($barcode);
    header ('Location:cart.php');
}
if (isset( $_GET['action']) && $_GET['action'] == 'reduce_quantity' ){
    $barcode = $_GET['barcode'];
    $cart -> reduce_quantity($barcode);
    header ('Location:cart.php');
}
if (isset( $_GET['action']) && $_GET['action'] == 'delite_item' ){
    $barcode = $_GET['barcode'];
    $cart -> delite_item($barcode);
}
if (isset( $_GET['action']) && $_GET['action'] == 'delite_cart' ){
    $barcode = $_GET['barcode'];
    $cart -> delite_cart($barcode);
}

echo "</div>";
echo "</div>";
create_footer(['home','products','login','logout']);

?>