<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Register New Member
            <small>Manually register a new member under you</small>
        </h1>
        <?php echo $breadcrumb; ?>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12" id="msg">
                <?php echo $this->session->userdata('msg'); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-2 col-xs-12 sm-0"></div>
            <div class="col-lg-6 col-md-6 col-sm-8 col-xs-12">
                <div class="register-box">
                    <div class="register-box-body">
                        <p class="login-box-msg">Member Information</p>

                        <form action="<?php echo base_url(); ?>sign-up/<?php echo $this->Util_model->get_user_info($this->session->userdata(UID), 'username', 'profile'); ?>/1" method="post">
                            <div class="form-group has-feedback">
                                <input type="text" name="name" class="form-control" placeholder="Full name" value="<?php echo set_value('name'); ?>">
                                <span class="glyphicon glyphicon-user form-control-feedback"></span>
                            </div>
                            <div class="form-group has-feedback">
                                <input type="text" name="username" class="form-control" placeholder="Username" value="<?php echo set_value('username'); ?>">
                                <span class="fa fa-at form-control-feedback"></span>
                            </div>
                            <div class="form-group has-feedback">
                                <input type="email" name="email" class="form-control" placeholder="Email" value="<?php echo set_value('email'); ?>">
                                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                            </div>
                            <div class="form-group has-feedback">
                                <div class="row">
                                    <div class="col-xs-4" style="padding-right: 0px">
                                        <select class="form-control" name="code" style="padding-right: 0px;">
                                            <?php
                                            $s = $this->Db_model->selectGroup("*", "countries", "ORDER BY name");
                                            foreach ($s->result_array() as $row) {
                                                $selected = ($row['id'] == set_value("code")) ? "selected='selected'" : "";
                                                echo "<option value='$row[id]' $selected>$row[phone_code] ($row[name])</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-xs-8">
                                        <div class="input-group">
                                            <!-- /btn-group -->
                                            <input type="tel" class="form-control" name="phone" placeholder="Phone number (no + or 0)" value="<?php echo set_value('phone'); ?>">
                                            <span class="glyphicon glyphicon-phone form-control-feedback"></span>
                                        </div>
                                        <!-- /input-group -->
                                    </div>
                                </div>
                            </div>
                            <div class="form-group has-feedback">
                                <input type="password" name="password" class="form-control" required readonly placeholder="Password" value="<?php echo $this->Util_model->generate_id(111111, 999999, "user_profile", "password", "var", true, 'f'); ?>">
                                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                            </div>
                            <div class="row">
                                <div class="col-xs-8" style="padding-left:35px">
                                </div>
                                <!-- /.col -->
                                <div class="col-xs-4">
                                    <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
                                </div>
                                <!-- /.col -->
                            </div>
                        </form>
                    </div>
                    <!-- /.form-box -->
                </div>
                <!-- /.register-box -->
            </div>
            <div class="col-lg-3 col-md-3 col-sm-2 col-xs-12 sm-0"></div>
        </div>
        <!--/.row-->
    </section>
</div>
