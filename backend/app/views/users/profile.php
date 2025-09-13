<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            My Profile
        </h1>
        <?php echo $breadcrumb; ?>
    </section>

    <!-- Main content -->
    <section class="content">
        <?php if ($uid == 0) : ?>
        <div class="row">
            <div class="col-xs-12" id="msg">
                <?php echo $this->session->userdata('msg'); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <div class="box no-border">
                    <div class="box-body top-pad-2x">
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 pull-left">
                            <h4>Personal Details</h4>
                            <hr>
                            <?php echo form_open(base_url()."home/update_personal"); ?>
                            <div class="row top-2x">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Name <span class="required">*</span></label>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                    <div class="form-group">
                                        <input class="form-control" type="text" name="name" value="<?php echo $pro['name']; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row top-2x">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Email <span class="required">*</span></label>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                    <div class="form-group">
                                        <input class="form-control" readonly type="email" name="email" value="<?php echo $pro['email']; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row top-2x">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Phone Number <span class="required">*</span></label>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                    <div class="form-group">
                                        <input class="form-control" readonly type="text" name="phone" value="<?php echo $pro['phone']; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row top-2x">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Username <span class="required">*</span></label>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                    <div class="form-group">
                                        <input class="form-control" readonly type="text" name="username" value="<?php echo $pro['username']; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row top-2x">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <button class="btn btn-success pull-right" type="submit">Save</button>
                                    </div>
                                </div>
                            </div>
                            <?php echo form_close(); ?>
                            <!--/. Business details-->
                            <h4>Change Password</h4>
                            <hr>
                            <?php echo form_open(base_url()."home/update_password"); ?>
                            <div class="row top-2x">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Current Password</label>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                    <div class="form-group">
                                        <input class="form-control" type="password" name="cur_password" placeholder="Enter min. 6 characters">
                                    </div>
                                </div>
                            </div>
                            <div class="row top-2x">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>New Password</label>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                    <div class="form-group">
                                        <input class="form-control" type="password" name="new_password" placeholder="Alphanumeric character">
                                    </div>
                                </div>
                            </div>
                            <div class="row top-2x">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <label>Confirm Password</label>
                                </div>
                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                    <div class="form-group">
                                        <input class="form-control" type="password" name="con_password" placeholder="Re-enter the new password">
                                    </div>
                                </div>
                            </div>
                            <div class="row top-2x">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group">
                                        <button class="btn btn-success pull-right" type="submit">Change Password</button>
                                    </div>
                                </div>
                            </div>
                            <?php echo form_close(); ?>
                        </div>
                    </div>
                </div>
                <!-- /.box -->
            </div>
        </div>
        <!--/.row-->
        <?php else : ?>
        <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-2 col-xs-12 sm-0"></div>
            <div class="col-lg-6 col-md-6 col-sm-8 col-xs-12">
                <div class="box box-widget widget-user">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <?php
                    $main = $this->Util_model->get_info("user_main", "name, date", "WHERE uid=$uid");
                    $pro = $this->Util_model->get_info("user_profile", "*", "WHERE uid=$uid");
                    ?>
                    <div class="widget-user-header bg-aqua-active">
                        <h3 class="widget-user-username"><?php echo $main['name']; ?></h3>
                        <h5 class="widget-user-desc">@<?php echo $pro['username']; ?></h5>
                    </div>
                    <div class="widget-user-image">
                        <img class="img-circle" src="<?php echo base_url().$this->Util_model->picture($uid); ?>" alt="<?php echo $pro['username']; ?>">
                    </div>
                    <div class="box-footer">
                        <div class="row">
                            <div class="col-sm-6 border-right">
                                <div class="description-block">
                                    <h5 class="description-header"><?php echo number_format($this->Util_model->row_count("user_referral", "WHERE refID1=$uid")); ?></h5>
                                    <span class="description-text">REFERRED</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-6 border-right">
                                <div class="description-block">
                                    <h5 class="description-header"><i class="fa fa-dollar"></i><?php echo number_format($pro['net_worth']); ?></h5>
                                    <span class="description-text">NET WORTH</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <div class="box-footer no-padding">
                        <ul class="nav nav-stacked">
                            <li><a href="#">Level <span class="pull-right text-bold"><?php echo $this->Util_model->get_info("level", "name", "WHERE id=$pro[level]"); ?></span></a></li>
                            <li><a href="#">Coordinator <span class="pull-right text-bold"><?php echo ($pro['role'] == 1) ? "No" : "Yes"; ?></span></a></li>
                            <li><a href="#">Cell <span class="pull-right text-bold"><?php echo $this->Util_model->get_user_info($uid, "cid", "cell"); ?></span></a></li>
                            <li><a href="#">Phone <span class="pull-right text-bold"><?php echo $this->Util_model->get_info("countries", "phone_code", "WHERE id=$pro[country]").$pro['phone']; ?></span></a></li>
                            <li><a href="#">Email <span class="pull-right text-bold"><?php echo $pro["email"]; ?></span></a></li>
                            <li><a href="#">Referred by <span class="pull-right text-bold"><?php echo $this->Util_model->get_user_info($this->Util_model->get_user_info($uid, "refID1", "referral")); ?></span></a></li>
                            <li><a href="#">Registered on <span class="pull-right text-bold"><?php echo $main['date']; ?></span></a></li>
                        </ul>
                    </div>
                </div>
                <!-- /.widget-user -->
            </div>
            <div class="col-lg-3 col-md-3 col-sm-2 col-xs-12 sm-0"></div>
        </div>
        <!--/.row-->
        <?php endif; ?>
    </section>
</div>
