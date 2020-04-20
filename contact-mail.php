<?php

$others = null;
if (isset($_POST['submit'])) {


    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    require 'mailer/PHPMailer/PHPMailerAutoload.php';

    $name =  $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];



    $mail = new PHPMailer;
    //$mail->SMTPDebug = 3;
    //Set PHPMailer to use SMTP.
    $mail->isSMTP();
    //Set SMTP host name
    $mail->Host = "smtp.gmail.com";
    //Set this to true if SMTP host requires authentication to send email
    $mail->SMTPAuth = true;
    $mail->SMTPSecure = false;
    // $mail->SMTPDebug = 2;

    /*-----------------------------------*/
    $mail->Username = "r.baruah42@gmail.com";
    $mail->Password = "Guwahati#12345";
    /*--------------------------------------------*/
    $mail->SMTPSecure = "ssl";
    $mail->Port = 465;

    $mail->From = "r.baruah42@gmail.com";
    $mail->FromName = "Contact lead from Customers";

    //  Admin email
    $mail->addAddress('r.baruah42@gmail.com');

    $mail->isHTML(true);

    $mail->Subject = $message;
    $mail->Body = "Hi Chandan,<br><br>
The details of submitted form as follows<br><br>
Name : " . $name . "<br>" .
        "Email : " . $email . "<br>" .
        "Message : " . $message . "<br>";
    if (!$mail->send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
        echo "<script>alert('Mailer Error: '.$mail->ErrorInfo);</script>";
    } else {
        // echo "";
        echo "<script type='text/javascript'>  
        alert('Thanks! I will get back to you shortly');
        window.location='https://chandanbaruah.com/';
        </script>";
    }
}