<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo SITE_TITLE; ?> - Sign Up</title>
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

<body class="hold-transition register-page"
    style="background: url('<?php echo base_url(); ?>assets/img/bg-4.jpg') fixed;">
    <div class="register-box">
        <div class="register-logo">
            <a href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>assets/img/logo.png"
                    alt="FXTMart"></a>
        </div>

        <div class="register-box-body">
            <div class="col-xs-12 no-padding"><?php echo $this->session->userdata("msg"); ?></div>
            <p class="login-box-msg">Create and account</p>

            <form action="<?php echo base_url(); ?>sign-up" method="post">
                <div class="form-group has-feedback">
                    <input type="text" name="name" class="form-control" placeholder="Full name"
                        value="<?php echo set_value('name'); ?>" required>
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="text" name="username" class="form-control" placeholder="Username"
                        value="<?php echo set_value('username'); ?>" required>
                    <span class="fa fa-at form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="email" name="email" class="form-control" placeholder="Email"
                        value="<?php echo set_value('email'); ?>" required>
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <div class="row">
                        <div class="col-xs-4" style="padding-right: 0px">
                            <select class="form-control" name="code" style="padding-right: 0px;" required>
                                <?php
                                $s = $this->Db_model->selectGroup("*", "countries", "ORDER BY name");
                                $value = (set_value("code") == "") ? 240 : set_value("code");
                                foreach ($s->result_array() as $row) {
                                    $selected = ($row['id'] == $value) ? "selected='selected'" : "";
                                    echo "<option value='$row[id]' $selected>$row[phone_code] ($row[name])</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-xs-8">
                            <div class="input-group">
                                <!-- /btn-group -->
                                <input type="tel" class="form-control" name="phone"
                                    placeholder="Phone number (no + or 0)" value="<?php echo set_value('phone'); ?>"
                                    required>
                                <span class="glyphicon glyphicon-phone form-control-feedback"></span>
                            </div>
                            <!-- /input-group -->
                        </div>
                    </div>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="text" name="ref" class="form-control" placeholder="Who referred you? (optional)"
                        value="<?php echo (empty(set_value('ref'))) ? $ref_id : set_value('ref'); ?>">
                    <span class="glyphicon glyphicon-users form-control-feedback"></span>
                    <small>Leave blank if no one referred you.</small>
                </div>
                <div class="row">
                    <div class="col-xs-8" style="padding-left:35px">
                        <div class="checkbox icheck">
                            <label>
                                <input type="checkbox"> I agree to the <a href="#" required>terms</a>
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-warning btn-block btn-flat">Register</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <a href="<?php echo base_url(); ?>sign-in" class="text-center">I already have an account</a>
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