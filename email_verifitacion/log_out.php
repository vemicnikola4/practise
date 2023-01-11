<?php
    session_start();
echo "<div class='primary_container'>";
    unset($_SESSION['user']);
    setcookie('user', 0, time()-60*60*24, "/");
    header ( 'Location: index.php' );

echo "</div>";   


?>