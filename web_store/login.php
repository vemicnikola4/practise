<?php
session_start();
include "functions.php";
include "class_database.php";

echo "<div class='main_container'>";
create_header( ['home','products','login','logout'] );
echo "<div class='content'>";
if ( isset($_SESSION['user']) || isset ( $_COOKIE['user'] ) ){
    header ('Location:index.php');

}else{
    create_form('Log in','login.php', 'POST', ['hidden', 'email' , 'password' ,  'submit' ], ['action', 'email', 'password' ,'submit'], ['login','','','submit','false'],['', 'email', 'password' ,'']);
}

if ( isset($_POST['action'])  &&  $_POST['action'] == 'login'){
    $email =  $_POST['email'];
    $password =  $_POST['password'];
    $all_users = $base -> all_users();
    for ( $i = 0; $i < count ($all_users); $i++){
        if ( $all_users[$i]['email'] == $email && $all_users[$i]['password'] == $password ){
            $_SESSION['user'] = $email;
            $_SESSION['name'] = $all_users[$i]['name'];
            // if ( $checkbox == true ){
            //     setcookie('user',$email, time() + (60 * 60 * 24 * 30), "/");
            // }
            header ('Location:index.php');
        }else{
            echo "<p>Invalid email or password try again!</p>";
            echo "</div>";
            echo "</div>";
            create_footer( ['home','products','login','logout'] );
            exit;
        }
    }
}


echo "</div>";
echo "</div>";
create_footer( ['home','products','login','logout'] );

?>