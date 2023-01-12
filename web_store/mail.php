<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';
function send_mail($recipient_email, $subject, $message, $recipient_name){

    $mail = new PHPMailer();
    $mail->isSMTP(); 

    $mail->SMTPDebug = 0;
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'vemicnikola4@gmail.com';                     //SMTP username
    $mail->Password   = 'fojyeapyuqipyjgk';                               //SMTP password
    $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
    $mail->Port       = 587;  

    $mail->isHTML(true);      
    $mail->setFrom('vemicnikola4@gmail.com', 'Nikola IT SOLUTIONS');
    $mail->addAddress($recipient_email, $recipient_name);

    $mail->Subject=$subject;
    $content = $message;
    
    $mail->MsgHTML($content);
    if (!$mail->send()){
        echo "Error while sending. ";
        var_dump($mail);
        return false;
    }else{
        echo "Message sent succsessfully. ";
        return true;

    }
}

?>