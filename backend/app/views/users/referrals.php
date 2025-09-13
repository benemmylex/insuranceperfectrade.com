<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            My Network
            <small>All my networks</small>
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
            <div class="col-xs-12">
                <div class="box no-border">
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="input-group">
                            <span class="no-display" id="ref-link"><?php echo base_url()."sign-up/".$this->Util_model->get_user_info($this->session->userdata(UID), "username", "profile"); ?></span>
                            <span class="input-group-addon">Referral link</span>
                            <input class="form-control" type="text" readonly value="<?php echo base_url()."sign-up/".$this->Util_model->get_user_info($this->session->userdata(UID), "username", "profile"); ?>">
                            <div class="input-group-btn">
                                <button class="btn btn-primary" type="button" onclick="copyToClipboard($(this), $('#ref-link'))"><i class="fa fa-copy"></i> Copy</button>
                            </div>
                        </div>

                        <hr>

                        <!-- Info boxes -->
                        <div class="row">
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="info-box">
                                    <span class="info-box-icon bg-red">1st</span>

                                    <div class="info-box-content">
                                        <span class="info-box-text">1st Level</span>
                                        <span class="info-box-number"><?php echo number_format($this->Util_model->row_count("user_referral", "WHERE refID1=".$this->session->userdata(UID))) ?></span>
                                        <small class="text-muted">Direct referrals <span class="pull-right text-bold"><?php echo $this->Util_model->get_option("referral1"); ?>%</span></small>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </div>
                            <!-- /.col -->

                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="info-box">
                                    <span class="info-box-icon bg-purple-active">2nd</span>

                                    <div class="info-box-content">
                                        <span class="info-box-text">2nd Level</span>
                                        <span class="info-box-number"><?php echo number_format($this->Util_model->row_count("user_referral", "WHERE refID2=".$this->session->userdata(UID))) ?></span>
                                        <small class="text-muted">Indirect referrals <span class="pull-right text-bold"><?php echo $this->Util_model->get_option("referral2"); ?>%</span></small>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </div>
                            <!-- /.col -->

                            <!-- fix for small devices only -->
                            <div class="clearfix visible-sm-block"></div>

                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="info-box">
                                    <span class="info-box-icon bg-blue-active">3rd</span>

                                    <div class="info-box-content">
                                        <span class="info-box-text">3rd Level</span>
                                        <span class="info-box-number"><?php echo number_format($this->Util_model->row_count("user_referral", "WHERE refID3=".$this->session->userdata(UID))) ?></span>
                                        <small class="text-muted">Indirect referrals <span class="pull-right text-bold"><?php echo $this->Util_model->get_option("referral3"); ?>%</span></small>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </div>
                            <!-- /.col -->
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="info-box">
                                    <span class="info-box-icon bg-yellow"><i class="fa fa-trophy"></i></span>

                                    <div class="info-box-content">
                                        <span class="info-box-text">Coordinating</span>
                                        <span class="info-box-number"><?php echo number_format($this->Util_model->row_count("user_referral", "WHERE coordinator=".$this->session->userdata(UID))) ?></span>
                                        <small class="text-muted">Level reward <span class="pull-right text-bold"><?php echo $this->Util_model->get_option("coordinator_comm"); ?>%</span></small>
                                    </div>
                                    <!-- /.info-box-content -->
                                </div>
                                <!-- /.info-box -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <div class="table-responsive top-2x">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th style="width: 10px">#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Invested Amount</th>
                                        <th>1st Level</th>
                                        <th>2nd Level</th>
                                        <th>3rd Level</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                $s = $this->Db_model->selectGroup("*", "user_referral", "WHERE refID1=".$this->session->userdata(UID)." ORDER BY id DESC");
                                if ($s->num_rows() > 0) {
                                    $count = 1;
                                    foreach ($s->result_array() as $row) {
                                        $main = $this->Util_model->get_info("user_main", "name, date", "WHERE uid=$row[uid]");
                                        $pro = $this->Util_model->get_info("user_profile", "*", "WHERE uid=$row[uid]");
                                        $invested = number_format($this->Util_model->sum_field("investment", "amount", "WHERE uid=$row[uid]"), 2);
                                        $level1 = number_format($this->Util_model->row_count("user_referral", "WHERE refID1=$row[uid]"));
                                        $level2 = number_format($this->Util_model->row_count("user_referral", "WHERE refID2=$row[uid]"));
                                        $level3 = number_format($this->Util_model->row_count("user_referral", "WHERE refID3=$row[uid]"));
                                        $phone_code = $this->Util_model->get_info("countries", "phone_code", "WHERE id=$pro[country]");
                                        echo "
                                        <tr>
                                            <td>$count</td>
                                            <td>$main[name]</td>
                                            <td>$pro[email]</td>
                                            <td>$phone_code$pro[phone]</td>
                                            <td><i class='fa fa-dollar'></i>$invested</td>
                                            <td>$level1</td>
                                            <td>$level2</td>
                                            <td>$level3</td>
                                            <td>$main[date]</td>
                                        </tr>
                                        ";
                                    }
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <small class="text-warning">NB: Slide table left on <i>mobile</i></small>
                    </div>
                    <!--/.box-footer-->
                </div>
                <!-- /.box -->
            </div>
        </div>
        <!--/.row-->
    </section>
</div>
