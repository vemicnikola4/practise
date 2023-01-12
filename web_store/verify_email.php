<?php
session_start();
include "functions.php";
include "class_database.php";
include "mail.php";

//**Ver code for verifying email and registring */
if (!isset($_SESSION['verification_code'])){
    $_SESSION['verification_code'] = substr(str_shuffle('0123456789ABVGDEZIJKLMNOPRSTCUFHQW'),1,10);
}
    echo "<div class='main_container'>";
    create_header( ['home','products','login','logout'] );
    echo "<div class='content'>";
    if ( isset ( $_POST['action']) && $_POST['action']== 'register' ){
        if ( isset( $_POST ['email']) && isset( $_POST ['name']) && isset( $_POST ['last_name']) && isset( $_POST ['phone_number']) && isset( $_POST ['password'])){
            $email = $_POST ['email'];
            $name = $_POST ['name'];
            $last_name = $_POST ['last_name'];
            $phone_number = $_POST ['phone_number'];
            $password = $_POST ['password'];
            $all_users = $base->all_users();

            for ( $i = 0; $i < count ( $all_users ); $i++ ){
                if ( $email == $all_users[$i]['email']);
                echo "<p>You already have an account.</p>";
                echo "<div class='link'><a href='login.php?action=login'>Go to login</a></div>";
                exit;
            }

            if ( validate_password( $password ) == false ){
                echo "<p><a href='index.php'>Back to SING IN </a></p>";
                die ( '<p> At least one capital leter one number and one special caracter in password</p>' );
            }        
        }
            $verication_code = $_SESSION['verification_code'];
            if (send_mail($email, "Verification code", "Your Verification code is $verication_code . 
            Verify your email by entering this verification code in required field", $name)){
                create_form ('Enter your verifaction code ','verify_email.php', 'POST', ['hidden','hidden','hidden','hidden','hidden','hidden','text','submit'], ['action','email','name','last_name','phone_number','password','verification_code','submit'],['verify_email',$email,$name,$last_name, $phone_number,$password,'', 'submit'],['','','','','','','enter ferification code','']);
            }else{
                echo "<p>Message was not sent, check your email adress.</p>";
            }
    } 
    if ( isset ( $_POST['action']) && $_POST['action'] == 'verify_email' ){
        $ver_code = $_POST['verification_code'];
        if ( $ver_code == $_SESSION['verification_code']){
            $email = $_POST ['email'];
            $name = $_POST ['name'];
            $last_name = $_POST ['last_name'];
            $phone_number = $_POST ['phone_number'];
            $password = $_POST ['password'];
            $base -> insert_user ( $email, $name, $last_name, $phone_number, $password );
            unset ( $_SESSION['verification_code'] );
            echo "<p>Succsessfuly inserted</p>";
            header ( 'location: login.php' );
        }else{
            echo "<p> Wrong verification code try again </p>";
            create_form ('Enter your verifaction code ','verify_email.php', 'verify_email', 'POST', ['text','submit'], ['verification_code','submit'],['enter ferification code','']);
        }   
    }

    echo "</div>";
    echo "</div>";
    create_footer( ['home','products','login','logout'] );




?>