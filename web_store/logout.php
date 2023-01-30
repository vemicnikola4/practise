<?php
    session_start();
echo "<div class='primary_container'>";
    unset($_SESSION['user']);
    unset($_SESSION['employee']);
    unset($_SESSION['order_id']);
    setcookie('user', 0, time()-60*60*24, "/");
    setcookie('employee', 0, time()-60*60*24, "/");
    header ( 'Location: index.php' );

echo "</div>";   


?>