<?php
session_start();
include "mail.php";
include "class_database.php";
include "functions.php";

echo "<div class='primary_container'>";
create_header(['index','login','log_out']);

if (isset($_SESSION['user'])){
    header ('Location:index.php');
}
if (!isset($_SESSION['verification_code'])){
    $_SESSION['verification_code'] = substr(str_shuffle('0123456789ABVGDEZIJKLMNOPRSTCUFHQW'),1,10);
}
if ( isset( $_POST['action']) && $_POST['action'] == 'register'){

        //****checking if all the fields are field */

        if ( $_POST['name']=='' || $_POST['email']== '' || $_POST['password']== ''){
            echo "<div class='link'><a href='index.php'>BACK TO REGISTRATION</a></div>";
            die ("Fill all required fields ");
        }else{
            $name = $_POST['name'];
            $email = $_POST['email'];
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo "<div class='link'><a href='index.php'>BACK TO REGISTRATION</a></div>";
                die ("<p>Invalid email format!</p>");
            }
            $all_users = $base->all_users();
            for ( $i = 0; $i < count ( $all_users ); $i++ ){
                if ( $email == $all_users[$i]['email']);
                echo "<p>You already have an account.</p>";
                echo "<div class='link'><a href='login.php?action=login'>Go to login</a></div>";
                exit;
            }
            $password = $_POST['password'];

            //****checking if there is an capital leter */

            $leter = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','X'];
            $has = false;
            for ( $i = 0; $i < count ( $leter ); $i++){
                if ( strpos ($password, $leter[$i]) !== false){
                    $has = true;
                }
            }    
            if ( $has == false){
                echo "<div class='link'><a href='index.php'>BACK TO REGISTRATION</a></div>";
                die ("<p>At least one capital leter one number and one spetial qracter needed in password neaded</p>");
            }

            //****checking if there is an number in password */

            $number = ['0','1','2','3','4','5','6','7','8','9'];
            $has = false;
            for ( $i = 0; $i < count ( $number ); $i++){
                if ( strpos ($password, $number[$i]) !== false){
                    $has = true;
                }
            }    
            if ( $has == false){
                echo "<div class='link'><a href='index.php'>BACK TO REGISTRATION</a></div>";
                die ("<p>At least one capital leter one number and one spetial qracter needed in password neaded</p>");
            }    

            //****checking if there is an special caracter in password */

            $special_caracter = ['@','$','%','&'];
            $has = false;
            for ( $i = 0; $i < count ( $special_caracter ); $i++){
                if ( strpos ($password, $special_caracter[$i]) !== false){
                    $has = true;
                }
            }    
            if ( $has == false){
                echo "<div class='link'><a href='index.php'>BACK TO REGISTRATION</a></div>";
                die ("<p>At least one capital leter one number and one spetial qracter needed in password neaded</p>");
            } 

            //****sending a mail with php mailer. */

            $verication_code = $_SESSION['verification_code'];
            if (send_mail($email, "Verification code", "Your Verification code is $verication_code . 
            Verify your email by entering this verification code in required field", $name)){
                echo "<p>Check your mail message was sent.</p><br>";
                echo "<div class='form_div'>";
                echo "<form action='verify_email.php' method='POST'>";
                echo "<input type='hidden' name='action' value='sending_ver_code'>";
                echo "<input type='hidden' name='name' value=$name>";
                echo "<input type='hidden' name='email' value=$email>";
                echo "<input type='hidden' name='password' value=$password>";
                echo "<input type='text' name='verification_code' placeholder='enter verification code'>";
                echo "<div class='button'>";
                echo "<input type='submit' value='SUBMIT'>";
                echo "<div>";
                echo "</form>";
                echo "</div>";
            }else{
                echo "<p>Message was not sent, check your email adress.</p>";
            };
        }
    }

    //*** Inserting an user in msql */
    //*** After inserting an user in msql unseting $_SESSION['verification_code'] and sending to login.php */

    if ( isset( $_POST['action']) && $_POST['action'] == 'sending_ver_code'){
        if (isset($_POST['verification_code']) && $_POST['verification_code']==$_SESSION['verification_code']){
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $base->insert_user($name, $email , $password);
            unset($_SESSION['verification_code']);
            header ('Location:login.php');
        }else{
            echo "<p>Wrong ver code</p>";
        }
    }
    echo "</div >";
    create_footer(['index','login','log_out']);  

?>