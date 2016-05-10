<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Login Page</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="stylesheet" href="<?php echo http_b ?>bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <link rel="stylesheet" href="<?php echo http_b ?>dist/css/AdminLTE.min.css">
        <link rel="stylesheet" href="<?php echo http_b ?>plugins/iCheck/square/blue.css">
        <link rel="shortcut icon" href="<?php echo http_f ?>img/logo.ico">
    </head>
    <body class="hold-transition login-page">
        <div class="login-box">
			<h2 class="login-box-msg">SIPERPUS</b></h2>
            <div class="login-box-body">
                <br/>
                <p class = "login-box-msg">Sign in to start your session</p>
                <?php if ($this->session->flashdata('result') == 2) {
                    ?>
                    <div class='alert alert-danger'>
                        <button type="button" class="close" data-dismiss="alert" area-hidden="true">x</button>
                        <?php echo validation_errors()." ".$this->session->flashdata('error'); ?>
                    </div>
                    <?php
                } else {
                    
                }
                echo form_open('admin/auth')
                ?>
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" placeholder="Username" name='username' id='username' value="<?php echo $this->session->flashdata('username') ? $this->session->flashdata('username') : '' ?>" required >
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" placeholder="Password" name='password' id='password' required >
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-8">
                    </div>
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat" name='login' id='login'>Sign In <i class="fa fa-sign-in"></i></button>
                    </div>
                </div>
                <?php echo form_close() ?>
            </div>
        </div>
        <script src="<?php echo http_b ?>plugins/jQuery/jQuery-2.1.4.min.js"></script>
        <script src="<?php echo http_b ?>bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo http_b ?>plugins/iCheck/icheck.min.js"></script>
        <script>
            $(function () {
                $('input').iCheck({
                    checkboxClass: 'icheckbox_square-blue',
                    radioClass: 'iradio_square-blue',
                    increaseArea: '20%' // optional
                });
				
				document.getElementById('username').focus();
            });
        </script>
    </body>
</html>
