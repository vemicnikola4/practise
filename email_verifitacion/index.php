<?php
session_start();
include "mail.php";
include "class_database.php";
include "functions.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOME</title>
</head>
<body>
    <?php
    
    //primary container as a box for body
    echo "<div class ='primary_container'>";
    create_header(['index','login','log_out']);
    echo "<div class ='content'>";

    //checking if cokie or session is on if not give me an form
    if (isset($_SESSION['user']) || isset( $_COOKIE['user'])){
        echo "<p>Hello session is on</p>";
        echo "<div class='link'>";
            echo "<a href='log_out.php?action=logout'>Log Out</a>";
        echo "</div>";
    }else{   
?>
    <div class='form_div'>
        <form action="verify_email.php" method="POST">
            <input type="hidden" name="action" value="register">
            <input type="text" name="name" placeholder='name and lastname'>
            <input type="email" name="email" placeholder='email'>
            <input type="password" name="password" placeholder='password'>
            <div class='button'>
            <input type="submit" value="submit">
            </div>        
        </form>
        <div class='link'>
            <a href="log_out.php?action=logout">Log Out</a>
        </div>
    </div>
    
    <?php
    };    

    //closing pr container

    echo "</div>";
    echo "</div>";
    create_footer(['index','login','log_out']);  
?>
</body>
</html>