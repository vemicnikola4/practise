<?php
    session_start();
    include "class_cart.php";
    unset($_SESSION['user']);
    unset($_SESSION['employee']);
    unset($_SESSION['order_id']);
    $cart->delete_cart();
    setcookie('user', 0, time()-60*60*24, "/");
    setcookie('employee', 0, time()-60*60*24, "/");
    header ( 'Location: index.php' );



?>