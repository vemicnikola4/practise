<?php
session_start();
include 'functions.php';

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
    create_header( ['home','products','login','logout'] );
    echo "<div class='content'>";
    if (!isset( $_SESSION['user'] ) && !isset( $_COOKIE['user'] )){
        create_form('Sing_in','verify_email.php', 'POST' , ['hidden','email','text','text','text','password','submit'], ['action','email','name','last_name','phone_number','password','submit'], ['register','','','','','','submit',],['','email','name','last name', 'phone number', 'password','']);
    }else{
        echo "<h1>HELLO USER ARE WELCOME<h1>";
    }
  
    echo "</div>";
    echo "</div>";
    create_footer( ['home','products','login','logout'] );
    ?>
    

</body>
</html>