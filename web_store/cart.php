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
        create_header( ['home','products','login','logout'] );
        if ( isset($_GET['action']) && $_GET['action']=='delete_cart'){
            $order_id = $_GET['order_id'];
            $cart -> delete_cart();
            echo "<div><p>Theh detailes of your purhase has been sent to your email </p></div>";
        }
        if ( isset($_GET['action']) && $_GET['action']=='search_order'){
            $order_id = $_GET['order_id'];
            $base->show_cart($order_id);
            
            echo "</div>";       
            create_footer( ['home','products','login','logout'] );
            exit;
        }
        if (isset ($_GET['action']) && $_GET['action'] == 'submit' ){
            echo "<div style='border:solid width:200px'>";
            echo "<p>Would you like to prossead with your purchase</p>";
            echo "<a href='submit.php?action=confirm_purchase'>YES</a><br> <a href='cart.php'>BACK TO CART</a>";
            echo "</div>";
            echo "</div>";
            create_footer( ['home','products','login','logout'] );
            exit;

        }
        if ( !isset ($_SESSION['user']) && !isset($_COOKIE['user'])){
            create_form('Sing_in','verify_email.php', 'POST' , ['hidden','email','text','text','text','password','submit'], ['action','email','name','last_name','phone_number','password','submit'], ['register','','','','','','submit',],['','email','name','last name', 'phone number', 'password','']);
            echo "<h3>Already have an account</h3>";
            echo "<a href='login.php'>LOGIN</a>";
        }else{
            $cart -> show_cart();
        }
       
        // var_dump($_SESSION['cart']);
       
        ?>
        </div>
    </div>
    <?php
        create_footer( ['home','products','login','logout'] );

        ?>

</body>
</html>