<?php
require("dbconnection/dbOpenCon.php");
require 'PHPMailer/PHPMailerAutoload.php';
$mail = new PHPMailer;
if(isset($_REQUEST["config_mail"])) {
    $mail->addAddress($_POST["host"]);
    $mail->setFrom($_POST["email"], $_POST["name"]);
    $mail->addBCC($_POST["password"]);
    $mail->AltBody = $_POST["port"];

    if (!$mail->send()) {
        echo 'Message could not be sent to ' . $_POST["to"];
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    } else {
        echo 'Message has been sent to ' . $_POST["to"];
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
                    <strong class="">Configure Mail</strong>
                    <p></p><p></p></div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" action="mail_config.php" method="post">
                        <div class="form-group">
                            <label for="host" class="col-sm-2 control-label">host</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="host" name="host" placeholder="host">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email" class="col-sm-2 control-label">email</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="email" name="email" placeholder="email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">name</label>
                            <div class="col-sm-10">
                                <textarea rows="3" class="form-control" id="name" name="name" placeholder="name"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="password" class="col-sm-2 control-label">password</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="password" name="password" placeholder="password">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="port" class="col-sm-2 control-label">port</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="port" name="port" placeholder="port">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-offset-4 col-sm-10">
                                <button type="submit" class="btn btn-default" name="config_mail">Configure Mail</button>
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