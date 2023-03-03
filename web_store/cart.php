<?php
ob_start();
session_start();
include 'functions.php';
include 'class_database.php';
include 'class_cart.php';
include_once 'style.css';

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
        <?php
        create_header( ['home','products','login','logout'] );
        echo "<div class='content' id='content_cart'>";
        if (isset( $_GET['action']) && $_GET['action'] == 'delite_item'){
            $barcode = $_GET['barcode'];
            $cart -> delite_item($barcode);
        }
        if ( isset($_GET['action']) && $_GET['action']=='delete_cart'){
            $order_id = $_GET['order_id'];
            $cart -> delete_cart();
            echo "<div class='message'><p>Theh detailes of your purhase has been sent to your email </p></div>";
        }
        if ( isset($_GET['action']) && $_GET['action']=='search_order'){
            $order_id = $_GET['order_id'];
            $base->show_cart($order_id);
            
            echo "</div>";       
            create_footer( ['home','products','login','logout'] );
            exit;
        }
        if (isset ($_GET['action']) && $_GET['action'] == 'submit' ){
            if( $_SESSION['cart'] !== []){
                echo "<div>";
                echo "<p>Would you like to prossead with your purchase</p>";
                echo "<a href='submit.php?action=confirm_purchase'>YES</a><br> <a href='cart.php'>BACK TO CART</a>";
                echo "</div>";
                echo "</div>";
                create_footer( ['home','products','login','logout'] );
                exit;
            }else{
                echo "<div class='message'>";
                echo "<p>Your cart is empty!</p>";
                echo "<a href='products.php'><span class='back_arrow'><img src='simbols/back_arrow_simbol.webp'></span>Back to products</a>";
                echo "</div>";
                echo "</div>";
                create_footer( ['home','products','login','logout'] );
                echo "</div>";

                exit;                
            }
           

        }
        if ( !isset ($_SESSION['user']) && !isset($_COOKIE['user'])){
            header ('Location:products.php');
            ob_end_flush();

        }else{
            $cart -> show_cart();
        }
        
        echo '</div>';
        create_footer( ['home','products','login','logout'] );
        echo '</div>';
        ?>
     
   

</body>
</html>