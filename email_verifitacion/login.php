<?php
session_start();
include "class_database.php";
include "functions.php";

echo "<div class='primary_container'>";
create_header(['index','login','log_out']);
echo "<div class='content'>";



if ( isset($_SESSION['user'])){
    header ('Location:index.php');
}else{
    if( isset($_POST['action']) && $_POST['action']=="login"){
    if(isset($_POST['email']) && isset($_POST['password'])){
        $email = $_POST['email'];
        $password = $_POST['password'];
    }

    //***cheking if there is a user with this email and password */

    $all_users = $base->all_users();
    for ( $i = 0; $i < count( $all_users ); $i++)
    if ( $email == $all_users[$i]['email'] && $password == $all_users[$i]['password']){

        //***Set session. If checked remember me set cookie */

        $_SESSION['user']=$email;
        if ( $_POST['remember'] == true){
            setcookie('user',$email, time() + (60 * 60 * 24 * 30), "/");        
        }
        header ('Location:index.php');

        }else{
            echo "<div class='link'>";
            echo "<a href='login.php'>Back to login</a><br>";
            echo "</div>";
            die ('Wrong email or password try again!');
        }
     
}
}

?>
<div class='form_div'>
    <form action="login.php" method='POST'>
        <input type="hidden" name="action" value="login">
        <input type="email" name="email" placeholder='email'>
        <input type="password" name="password" placeholder='password'><br>
        <span>Remember me on this computer</span><input type="checkbox" name="remember" ><br>
        <input type="submit" value="submit">
    </form>
</div>
</div>
</div>
<?php
    create_footer(['index','login','log_out']);  
?>