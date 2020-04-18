<?php
error_reporting(0);
session_start();
if(!isset($_SESSION['type'])){
   print "<script>";
   print 'alert("You need to login first "); location.href="http://gocareer.net/jobportal/login/login.php";';
   print "</script>";
   }	else if($_SESSION['type']!='institute'){
	  print "<script>";
	  print 'alert("You cannot access this page "); location.href="http://gocareer.net/index.php";';
	  print "</script>";
	  }	else{
		 $dataarray = $_POST['dt'];
		 $cid = $dataarray[0];
		 require("../../dbconnection/dbOpenCon.php");
		 $query = "select * from students where id=$cid";
		 $result = mysql_query($query);
		 $row= mysql_fetch_array($result);
        include '../dbconnection/dbCloseCon.php';
	}
require 'PHPMailer/PHPMailerAutoload.php';
require '../../dbconnection/dbOpenCon.php';
	$name="Abhijit";
	$email="abhijitsaikia55@gmail.com";
	//mail sending part
	$mail = new PHPMailer;
   	$mail->isSMTP();                                      // Set mailer to use SMTP
	$mail->Host = 'mail.gocareer.net';  // Specify main and backup SMTP servers
	$mail->SMTPAuth = true;
	$uname=  'info@gocareer.net' ;                           // Enable SMTP authentication
	$mail->Username = 'info@gocareer.net';                 // SMTP username
	$mail->Password = 'ranajit@gc1';                           // SMTP password
	//$mail->SMTPSecure = '';                            // Enable TLS encryption, `ssl` also accepted
	$mail->Port = 25;                                    // TCP port to connect t
	$mail->setFrom('info@gocareer.net', 'Gocareer');
	$mail->addAddress('abhijitsaikia55@gmail.com', 'Abhijit');     // Add a recipient
	$mail->addAddress('ibmr.gocareer.net');
	//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
	//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
	$mail->isHTML(true);                                  // Set email format to HTML
	$mail->Subject = "Subject";
	$mail->Body    =  "Body";
	$mail->AltBody = "Alt Body";

	if(!$mail->send()) {
 	   echo 'Message could not be sent.';
   	 echo 'Mailer Error: ' . $mail->ErrorInfo;
	} else {
    		echo 'Message has been sent';
	}
?>
