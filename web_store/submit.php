<?php
session_start();
include_once "class_database.php";
include "class_cart.php";
$cart = $_SESSION['cart'];
$time = date ( 'Y-m-d H:i:s' );
if ( !isset($_SESSION['order_id'])){
    $_SESSION['order_id'] = substr(str_shuffle('0123456789ABVGDEZIJKLMNOPRSTCUFHQW'),1,10);
}
if (isset ($_GET['action']) && $_GET['action'] == 'submit' ){
    if ( $_SESSION['cart'] !== []){
        for ( $i = 0; $i < count($cart); $i++ ){
            $order_id = $_SESSION['order_id'];
            $barcode = $cart[$i]['barcode'];
            $quantity = $cart[$i]['quantity'];
            $price = $cart[$i]['price'];
            $total =  $price * $quantity;
            // echo $cart[$i]['item_total'];
            $base -> insert_into_cart($order_id, $barcode, $quantity, $total, $time);
    }
    unset($_SESSION['order_id']);
    header ('Location: cart.php?action=delete_cart&order_id='.$order_id.'' );
    }else{
        header ( 'Location: cart.php' );

    }
}


?>