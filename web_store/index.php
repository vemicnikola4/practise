<?php
ob_start();
session_start();
include 'functions.php';
include 'class_database.php';
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
    <div class='main_container'>
    <?php
    create_header( ['home','products','cart','login','logout'] );
    echo "<div class='content' id='index_content'>";

    if (!isset( $_SESSION['user'] ) && !isset( $_COOKIE['user'] )){
        create_form('Sing in','verify_email.php', 'POST' , ['hidden','email','text','text','text','password','submit'], ['action','email','name','last_name','phone_number','password','submit'], ['register','','','','','','submit',],['','email','name','last name', 'phone number', 'password','']);
    }else{
        header ('Location:products.php');
        ob_end_flush();

    }
  
    echo "</div>";
    create_footer( ['home','products','cart','login','logout','product_forms'] );
    echo "</div>";
    
    
    ?>


</body>
</html>