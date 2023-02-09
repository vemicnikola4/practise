<?php
session_start();
include_once "class_database.php";
include "class_cart.php";
include "mail.php";
$cart_items = $_SESSION['cart'];
$time = date ( 'Y-m-d H:i:s' );
if ( !isset($_SESSION['order_id'])){
    $_SESSION['order_id'] = substr(str_shuffle('0123456789ABVGDEZIJKLMNOPRSTCUFHQW'),1,10);
}

if (isset ($_GET['action']) && $_GET['action'] == 'confirm_purchase' ){
    if ( $_SESSION['cart'] !== []){
        for ( $i = 0; $i < count($cart_items); $i++ ){
            $order_id = $_SESSION['order_id'];
            $barcode = $cart_items[$i]['barcode'];
            $quantity = $cart_items[$i]['quantity'];
            $price = $cart_items[$i]['price'];
            $total =  $price * $quantity;
            // echo $cart_items[$i]['item_total'];
            $product = $base->one_product($barcode);
            $available_quantity=$product[0]['quantity'];
            $base -> reduce_quantity($barcode,$quantity);
            if ( $product[0]['quantity'] < 0){
                echo "<p>Not aveilable, try another products or change quantity</p>";
                $base->add_quantity($barcode,$available_quantity);
                exit;
            }
            $base -> insert_into_cart($order_id, $barcode, $quantity, $total, $time);
    }
    $array_string="";
    for ( $i = 0; $i < count($cart_items); $i++ ){
       $string = implode(" ",$cart_items[$i]);
       $position = strlen($string);
       $array_string .= $string . '.';
       
    }
    unset($_SESSION['order_id']);
    send_mail($_SESSION['user'], "Order  ", "Your order has been prossessed.
    Folow the link to se your order http://localhost/primeriphp/vezba/web_store/cart.php?action=search_order&order_id=$order_id . 
    Thank you for shoping with us", $_SESSION['name']);
    header ('Location: cart.php?action=delete_cart&order_id='.$order_id.'' );
    }else{
        header ( 'Location: cart.php' );

    }
}


?>