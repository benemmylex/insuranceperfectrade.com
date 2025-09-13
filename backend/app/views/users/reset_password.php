<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo SITE_TITLE; ?> - Forgot Password</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="<?= base_url(); ?>assets/img/favicon.png" />
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/img/favicon.png" type="image/x-icon">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/ionicons-2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/iCheck/square/blue.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body class="hold-transition register-page" style="background: url('<?php echo base_url(); ?>assets/img/bg-4.jpg') fixed;">
<div class="register-box">
    <div class="register-logo">
        <a href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>assets/img/logo.png" alt="FXTMart"></a>
    </div>

    <div class="register-box-body">

        <?php if (!$this->session->has_userdata('uid') || !$this->session->has_userdata('auth_text')) : ?>
            <div class="col-xs-12 no-padding"><?php echo $this->session->userdata("msg"); ?></div>
            <p class="login-box-msg">Reset my password</p>
                <?php echo form_open(base_url().'users/send-reset-link',"id='sign-in-form'"); ?>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="form-group">
                            <input type="text" class="form-control" name="email" id="email" placeholder="you@example.com" value="<?php echo set_value('user'); ?>">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <button type="submit" class="btn btn-info no-curve pull-right">Send Reset Link</button>
                    </div>
                </div>
                <?php echo form_close(); ?>
                <a href="<?php echo base_url(); ?>sign-in" class="text-center">Sign in</a> |
                <a href="<?php echo base_url(); ?>sign-up" class="text-center">Create an account</a>
            </div>

        <?php else : ?>

            <div class="col-xs-12 no-padding"><?php echo $this->session->userdata("msg"); ?></div>
            <p class="login-box-msg">Create new password</p>
                <?php echo form_open(base_url().'users/change-password',"id='sign-in-form'"); ?>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="form-group">
                            <label for="pass">New Password</label>
                            <input type="password" class="form-control" name="pass" id="pass" placeholder="Unique passkey">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <button type="submit" class="btn btn-info no-curve pull-right">Change Password</button>
                    </div>
                </div>
                <?php echo form_close(); ?>
                <a href="<?php echo base_url(); ?>sign-in" class="text-center">Sign in</a> |
                <a href="<?php echo base_url(); ?>sign-up" class="text-center">Create an account</a>
            </div>

        <?php endif; ?>

    </div>
    <!-- /.form-box -->
</div>
<!-- /.register-box -->

<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url(); ?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?php echo base_url(); ?>assets/plugins/iCheck/icheck.min.js"></script>
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    });
</script>
</body>
</html>


