<?php
require 'PHPMailer/PHPMailerAutoload.php';
require 'dbconnection/dbOpenCon.php';
include 'excel_reader/excel_reader.php';
session_start();     // include the class
// creates an object instance of the class, and read the excel file data

$excel = new PhpExcelReader;
$excel->read('uploads/test.xls');
if(isset($_REQUEST["send_mail"])) {
function sheetData($sheet) {
  $x = 1;

  while($x <= $sheet['numRows']) {
    $y = 1;
	$_SESSION["s_name"]= isset($sheet['cells'][$x][2]) ? $sheet['cells'][$x][2] : '';
	$_SESSION["s_email"] = isset($sheet['cells'][$x][1]) ? $sheet['cells'][$x][1] : '';
	$name=$_SESSION["s_name"];
	$email=$_SESSION["s_email"];
	$type=1;
	$query = "INSERT INTO peoples(name,email,type_id)
        VALUES('$name', '$email','$type')";
    $result = mysql_query($query);
	echo $name;
	echo "\t$email\n";
	//mail sending part
	$mail = new PHPMailer;
   	$mail->isSMTP();                                      // Set mailer to use SMTP
	$mail->Host = 'mail.tjs.co.in';  // Specify main and backup SMTP servers
	$mail->SMTPAuth = true;                               // Enable SMTP authentication
	$mail->Username = 'bulkmail@tjs.co.in';                 // SMTP username
	$mail->Password = 'bulkmail';                           // SMTP password
	//$mail->SMTPSecure = '';                            // Enable TLS encryption, `ssl` also accepted
	$mail->Port = 587;                                    // TCP port to connect t
	$mail->setFrom('bulkmail@tjs.co.in', 'TJS Solution');
	$mail->addAddress($email, $name);//Add a recipient
	//$mail->addAddress('ellen@example.com');               // Name is optional
	//$mail->addReplyTo('info@example.com', 'Information');
	//$mail->addCC($_POST["cc"];);
	//$mail->addBCC('bcc@example.com');

	//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
	//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
	$mail->isHTML(true);                                  // Set email format to HTML
	$mail->Subject = $_POST["subject"];
	$mail->Body    =  $_POST["mytextarea"];
	$mail->AltBody = $_POST["alt_body"];

	if(!$mail->send()) {
 	   echo 'Message could not be sent.';
   	 echo 'Mailer Error: ' . $mail->ErrorInfo;
	} else {
    		echo 'Message has been sent';
	}
    $x++;
  }
	 $_SESSION["noRows"]=$x;
}

$nr_sheets = count($excel->sheets);       // gets the number of sheets
$excel_data = '';
             // to store the the html tables with data of each sheet

// traverses the number of sheets and sets html table with each sheet data in $excel_data
for($i=0; $i<$nr_sheets; $i++) {
  $excel_data .= '<h4>Sheet '. ($i + 1) .' (<em>'. $excel->boundsheets[$i]['name'] .'</em>)</h4>'. sheetData($excel->sheets[$i]) .'<br/>';  
} 
}
?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <title>Property Portal | institute Add</title>
    <link href="bootstrap-3.3.2-dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap-3.3.2-dist/css/login.css" rel="stylesheet">
    <link href="bootstrap-3.3.2-dist/css/menu1.css" rel="stylesheet">
    <script src="bootstrap-3.3.2-dist/js/bootstrap.min.js"></script>
    <script src="bootstrap-3.3.2-dist/js/jquery-1.11.2.min.js"></script>
	<script src="tinymce/tinymce.min.js"></script>
  <script>
    tinymce.init({
      selector: "#mytextarea"
    });
  </script>
</head>

<body class="b">
<div class="navbar navbar-default navbar-fixed-top" role="navigation">
	<div class="container-fluid">
    	<div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#my-navbar-collapse-1">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button> 
            <div class="title">Mail Server</div>
		</div>
    </div>
</div>
<div class="container">
	<div class="row">
    	<div class="col-md-6 col-md-offset-3">
        	<div class="panel">
            <div class="panel-heading new-heading"><p></p><p></p>
            <strong class="">Compose Mail</strong>
            <p></p><p></p></div>
                <div class="panel-body">
			<form class="form-horizontal" role="form" action="index.php" method="post">

                     	<div class="form-group">
                        	<label for="from_mail" class="col-sm-2 control-label">Enter Your Email</label>
                        	<div class="col-sm-10">
                          		<input type="text" class="form-control" id="from_mail" name="from_mail" placeholder="from">
                      		</div>
                        </div>
                        <div class="form-group">
                        	<label for="from_name" class="col-sm-2 control-label">Name want to display</label>
                        	<div class="col-sm-10">
                          		<input type="text" class="form-control" id="from_name" name="from_name" placeholder="from">
                      		</div>
                        </div>
						
						<div class="form-group">
                        	<label for="from_password" class="col-sm-2 control-label">Enter Your password</label>
                        	<div class="col-sm-10">
                          		<input type="text" rows="3" class="form-control" id="from_password" name="from_password" placeholder="Password">
                      		</div>
                        </div> 
						<div class="form-group">
                        	<label for="subject" class="col-sm-2 control-label">subject</label>
                        	<div class="col-sm-10">
                          		<input type="text" class="form-control" id="subject" name="subject" placeholder="subject">
                      		</div>
                        </div>
                        <!--<div class="form-group">
                        	<label for="cc" class="col-sm-2 control-label">cc</label>
                        	<div class="col-sm-10">
                          		<input type="text" class="form-control" id="cc" name="cc" placeholder="cc">
                      		</div>
                        </div>-->
                        <div class="form-group">
                        	<label for="mytextarea" class="col-sm-2 control-label">Message</label>
                        	<div class="col-sm-10">
                          		
    								<textarea id="mytextarea" name="mytextarea"></textarea>

                      		</div>
                        </div>
                        <div class="form-group">
                        	<label for="alt_body" class="col-sm-2 control-label">alt_body</label>
                        	<div class="col-sm-10">
                          		<input type="text" class="form-control" id="alt_body" name="alt_body" placeholder="alt_body">
                      		</div>
                        </div>
                      	<div class="form-group">
                        	<div class="col-sm-offset-4 col-sm-10">
                          		<button type="submit" class="btn btn-default" name="send_mail">Send Message</button>
                        	</div>
                      	</div>
                    </form>
                    
  
				</div>
			</div>
		</div>
	</div>
</div>
</body>
</html>