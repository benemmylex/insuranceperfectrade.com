<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Dashboard
            <small>All you need is here</small>
        </h1>
        <?php echo $breadcrumb; ?>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <?php if ($this->Util_model->get_info("user_profile", "verified", "WHERE uid=" . $this->session->userdata(UID)) == 0): ?>
                <div class="col-xs-12">
                    <div class="alert alert-danger">
                        Your account is not yet verified. <a
                            href="<?php echo base_url(); ?>users/send_email_verification_link/<?php echo $this->session->userdata(UID); ?>">Resend
                            Verification Link</a>
                    </div>
                </div>
            <?php endif; ?>
            <div class="col-xs-12" id="msg">
                <?php echo $this->session->userdata('msg'); ?>
            </div>
        </div>
        <div class="well">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                    <div class="input-group">
                        <span class="no-display"
                            id="ref-link"><?php echo base_url() . "sign-up/" . $this->Util_model->get_user_info($this->session->userdata(UID), "username", "profile"); ?></span>
                        <span class="input-group-addon">Referral link</span>
                        <input class="form-control" type="text" readonly
                            value="<?php echo base_url() . "sign-up/" . $this->Util_model->get_user_info($this->session->userdata(UID), "username", "profile"); ?>">
                        <div class="input-group-btn">
                            <button class="btn btn-primary" type="button"
                                onclick="copyToClipboard($(this), $('#ref-link'))"><i class="fa fa-copy"></i>
                                Copy</button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <a class="btn btn-warning btn-block" href="<?php echo base_url(); ?>add-member">
                        <i class="fa fa-user-plus"></i> Register New Member
                    </a>
                </div>
            </div>
        </div>
        <!-- Info boxes -->
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="fa fa-money"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Balance</span>
                        <span
                            class="info-box-number"><?php echo $this->General_model->get_balance($this->session->userdata(UID)); ?></span>
                        <small class="text-muted"><span class="label label-default sm">Today</span>
                            <?php echo $this->General_model->get_balance($this->session->userdata(UID), true, false, NULL, true); ?></small>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-purple-active"><i class="fa fa-usd"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Referral Bonus</span>
                        <span
                            class="info-box-number"><?php echo $this->General_model->get_balance($this->session->userdata(UID), true, true, 'Referral'); ?></span>
                        <small class="text-muted"><span class="label label-default sm">Referrals</span>
                            <?php echo $this->Util_model->row_count("user_referral", "WHERE refID1=" . $this->session->userdata(UID)); ?></small>
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
                    <span class="info-box-icon bg-red-active"><i class="fa fa-line-chart"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Investment</span>
                        <span
                            class="info-box-number"><?php echo USD . number_format($this->Util_model->sum_field("investment", "amount", "WHERE uid=" . $this->session->userdata(UID) . " AND status=0"), 2); ?></span>
                        <small class="text-muted"><span class="label label-default sm">Profit</span>
                            <?php echo $this->General_model->get_balance($this->session->userdata(UID), true, true, 'ROI'); ?></small>
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
                        <span class="info-box-text">Level</span>
                        <span
                            class="info-box-number"><?php $level = $this->Util_model->get_user_info($this->session->userdata(UID), "level", "profile");
                            echo ($level > 0) ? $this->Util_model->get_info("level", "name", "WHERE id=$level") : "Member"; ?></span>
                        <small class="text-muted"><span class="label label-default sm">Net Worth</span> <i
                                class="fa fa-dollar"></i><?php echo number_format($this->Util_model->get_user_info($this->session->userdata(UID), "net_worth", "profile"), 2); ?></small>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row bottom-2x">
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 top-1x">
                <a href="<?php echo base_url(); ?>fund" class="btn btn-primary btn-block">Deposit</a>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 top-1x">
                <a href="<?php echo base_url(); ?>withdraw" class="btn btn-primary btn-block">Withdraw</a>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 top-1x">
                <a href="<?php echo base_url(); ?>forex-plan" class="btn btn-primary btn-block">Invest</a>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 top-1x">
                <a href="<?php echo base_url(); ?>card" class="btn btn-primary btn-block">Card</a>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 top-1x">
                <a href="<?php echo base_url(); ?>loan" class="btn btn-primary btn-block">Loan</a>
            </div>
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 top-1x">
                <a href="<?php echo base_url(); ?>referrals" class="btn btn-primary btn-block">My Network</a>
            </div>
        </div>
        <!-- <div class="row">
            <div class="col-xs-12">
                <div class="alert alert-info">
                    <h4 class="text-bold"><i class="fa fa-support"></i> 24/7 Coordinator Support </h4>
                    You can chat up your coordinator for any clarification and questioning. Please note that
                    coordinators are not the system admin rather they are special members who has deep understanding on how the
                    system works, so do not share vital information like your <b>password</b> with them as no admin will ask for your password either.
                </div>
            </div>
        </div> -->
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Revenue Report</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                    class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                    class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="row">
                            <div class="col-md-8">
                                <p class="text-center">
                                    <strong>Revenues: 1 Jan, <?php echo date('Y'); ?> - 31 Dec,
                                        <?php echo date('Y'); ?></strong>
                                </p>

                                <div class="chart">
                                    <!-- Sales Chart Canvas -->
                                    <canvas id="salesChart" style="height: auto;"></canvas>
                                </div>
                                <!-- /.chart-responsive -->
                            </div>
                            <!-- /.col -->
                            <div class="col-md-4">
                                <p class="text-center">
                                    <strong>Revenue Meter</strong>
                                </p>

                                <div class="progress-group">
                                    <?php
                                    $cashout = 0;
                                    $bonus = $this->General_model->get_balance($this->session->userdata(UID), false, true, 'ROI');
                                    $threshold = $this->Util_model->get_option("roi_threshold");
                                    if ($bonus > 0) {
                                        $times = floor($bonus / $threshold);
                                        if ($times > 0) {
                                            $bonus = $bonus % $threshold;
                                        }
                                        $per = get_percentage($threshold, $bonus, false);
                                    } else {
                                        $times = 0;
                                        $per = 0;
                                    }
                                    $cashout += ($times * $threshold);
                                    ?>
                                    <span class="progress-text">Daily ROI</span>
                                    <span class="progress-number"><b><?php echo USD . round($bonus); ?></b> /
                                        <?php echo USD . round($threshold); ?>
                                        (<?php echo USD . number_format($times * $threshold); ?>)</span>

                                    <div class="progress sm">
                                        <div class="progress-bar progress-bar-aqua" style="width: <?php echo $per; ?>%">
                                        </div>
                                    </div>
                                </div>
                                <!-- /.progress-group -->
                                <div class="progress-group">
                                    <?php
                                    $bonus = $this->General_model->get_balance($this->session->userdata(UID), false, true, 'Referral');
                                    $threshold = $this->Util_model->get_option("referral_threshold");
                                    if ($bonus > 0) {
                                        $times = floor($bonus / $threshold);
                                        if ($times > 0) {
                                            $bonus = $bonus % $threshold;
                                        }
                                        $per = get_percentage($threshold, $bonus, false);
                                    } else {
                                        $times = 0;
                                        $per = 0;
                                    }
                                    $cashout += ($times * $threshold);
                                    ?>
                                    <span class="progress-text">Referral Bonus</span>
                                    <span class="progress-number"><b><?php echo USD . round($bonus); ?></b> /
                                        <?php echo USD . round($threshold); ?>
                                        (<?php echo USD . number_format($times * $threshold); ?>)</span>

                                    <div class="progress sm">
                                        <div class="progress-bar progress-bar-red" style="width: <?php echo $per; ?>%">
                                        </div>
                                    </div>
                                </div>
                                <!-- /.progress-group -->
                                <!-- <div class="progress-group">
                                    <?php
                                    /* $bonus = $this->General_model->get_balance($this->session->userdata(UID), false, true, 'Group');
                                    $threshold = $this->Util_model->get_option("group_threshold");
                                    if ($bonus > 0) {
                                        $times = floor($bonus / $threshold);
                                        if ($times > 0) {
                                            $bonus = $bonus % $threshold;
                                        }
                                        $per = get_percentage($threshold, $bonus, false);
                                    } else {
                                        $times = 0;
                                        $per = 0;
                                    }
                                    $cashout += ($times * $threshold); */
                                    ?>
                                    <span class="progress-text">Cell Bonus</span>
                                    <span class="progress-number"><b><?php echo USD . round($bonus); ?></b> / <?php echo USD . round($threshold); ?> (<?php echo USD . number_format($times * $threshold); ?>)</span>

                                    <div class="progress sm">
                                        <div class="progress-bar progress-bar-green" style="width: <?php echo $per; ?>%"></div>
                                    </div>
                                </div> -->
                                <!-- /.progress-group -->
                                <div class="progress-group">
                                    <?php
                                    $bonus = $this->General_model->get_balance($this->session->userdata(UID), false, true, 'Reinvest');
                                    $threshold = $this->Util_model->get_option("reinvest_threshold");
                                    if ($bonus > 0) {
                                        $times = floor($bonus / $threshold);
                                        if ($times > 0) {
                                            $bonus = $bonus % $threshold;
                                        }
                                        $per = get_percentage($threshold, $bonus, false);
                                    } else {
                                        $times = 0;
                                        $per = 0;
                                    }
                                    $cashout += ($times * $threshold);
                                    ?>
                                    <span class="progress-text">Reinvest Bonus</span>
                                    <span class="progress-number"><b><?php echo USD . round($bonus); ?></b> /
                                        <?php echo USD . round($threshold); ?>
                                        (<?php echo USD . number_format($times * $threshold); ?>)</span>

                                    <div class="progress sm">
                                        <div class="progress-bar progress-bar-yellow"
                                            style="width: <?php echo $per; ?>%"></div>
                                    </div>
                                </div>
                                <!-- /.progress-group -->
                                <!-- <div class="progress-group">
                                    <?php
                                    /* $bonus = $this->General_model->get_balance($this->session->userdata(UID), false, true, 'Coordinator');
                                    $threshold = $this->Util_model->get_option("coordinator_threshold");
                                    if ($bonus > 0) {
                                        $times = floor($bonus / $threshold);
                                        if ($times > 0) {
                                            $bonus = $bonus % $threshold;
                                        }
                                        $per = get_percentage($threshold, $bonus, false);
                                    } else {
                                        $times = 0;
                                        $per = 0;
                                    }
                                    $cashout += ($times * $threshold); */
                                    ?>
                                    <span class="progress-text">Coordinator Bonus</span>
                                    <span class="progress-number"><b><?php echo USD . round($bonus); ?></b> / <?php echo USD . round($threshold); ?> (<?php echo USD . number_format($times * $threshold); ?>)</span>

                                    <div class="progress sm">
                                        <div class="progress-bar progress-bar-primary" style="width: <?php echo $per; ?>%"></div>
                                    </div>
                                </div> -->
                                <!-- /.progress-group -->
                                <div class="well text-center no-padding">
                                    <h3>
                                        <?php echo USD . number_format($cashout); ?><br>
                                        <small>Available Revenue</small>
                                    </h3>
                                </div>
                                <div class="btn-group btn-group-sm" style="width:100%">
                                    <a href="javascript:;" class="btn btn-danger" style="width:50%"
                                        title="Available revenue will be sent to balance" data-toggle="tooltip"
                                        onclick="cashout('<?php echo base_url(); ?>/home/cashout', '<?php echo $cashout; ?>', $(this));">Cashout
                                        Revenue</a>
                                    <a href="javascript:;" class="btn btn-success" style="width:50%"
                                        title="Available revenue will be reinvested and <?php echo $this->Util_model->get_option('reinvest_comm'); ?>% of the reinvested amount will be given"
                                        data-toggle="tooltip"
                                        onclick="cashout('<?php echo base_url(); ?>/home/reinvest', '<?php echo $cashout; ?>', $(this));">Reinvest
                                        Revenue</a>
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- ./box-body -->
                    <div class="box-footer">
                        <div class="row">
                            <div class="col-sm-3 col-xs-6">
                                <div class="description-block border-right">
                                    <h5 class="description-header">
                                        <?php echo USD . number_format($this->Util_model->sum_field("user_bonus", "amount", "WHERE creditor=" . $this->session->userdata(UID) . " AND status=1"), 2); ?>
                                    </h5>
                                    <span class="description-text">TOTAL REVENUE</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-3 col-xs-6">
                                <div class="description-block border-right">
                                    <h5 class="description-header">
                                        <?php echo USD . number_format($this->Util_model->sum_field("user_bonus", "amount", "WHERE creditor=" . $this->session->userdata(UID) . " AND status=1 AND date LIKE '" . date('Y-m') . "%'"), 2); ?>
                                    </h5>
                                    <span class="description-text">MONTHLY REVENUE</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-3 col-xs-6">
                                <div class="description-block border-right">
                                    <h5 class="description-header">
                                        <?php echo USD . number_format($this->Util_model->sum_field("user_bonus", "amount", "WHERE creditor=" . $this->session->userdata(UID) . " AND status=1 AND YEARWEEK(date)=YEARWEEK(now())"), 2); ?>
                                    </h5>
                                    <span class="description-text">WEEKLY REVENUE</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-3 col-xs-6">
                                <div class="description-block">
                                    <h5 class="description-header">
                                        <?php echo USD . number_format($this->Util_model->sum_field("user_bonus", "amount", "WHERE creditor=" . $this->session->userdata(UID) . " AND status=1 AND date LIKE '" . date('Y-m-d') . "%'"), 2); ?>
                                    </h5>
                                    <span class="description-text">DAILY REVENUE</span>
                                </div>
                                <!-- /.description-block -->
                            </div>
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.box-footer -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- Main row -->
        <div class="row">
            <!-- Left col -->
            <div class="col-md-8">
                <!-- /.box -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="box box-default">
                            <div class="box-header with-border">
                                <h3 class="box-title">Revenue Flow</h3>
                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                            class="fa fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                            class="fa fa-times"></i></button>
                                </div>
                            </div>
                            <!-- /.box-header -->
                            <div class="box-body">
                                <?php
                                $roi = $this->Util_model->sum_field("user_bonus", "amount", "WHERE creditor=" . $this->session->userdata(UID) . " AND status>0 AND type='ROI'");
                                $referral = $this->Util_model->sum_field("user_bonus", "amount", "WHERE creditor=" . $this->session->userdata(UID) . " AND status>0 AND type='Referral'");
                                //$group = $this->Util_model->sum_field("user_bonus", "amount", "WHERE creditor=".$this->session->userdata(UID)." AND status>0 AND type='Group'");
                                $reinvest = $this->Util_model->sum_field("user_bonus", "amount", "WHERE creditor=" . $this->session->userdata(UID) . " AND status>0 AND type='Reinvest'");
                                //$coordinator = $this->Util_model->sum_field("user_bonus", "amount", "WHERE creditor=".$this->session->userdata(UID)." AND status>0 AND type='Coordinator'");
                                
                                $total = $roi + $referral + $roi + $reinvest;
                                $roi_per = ($total > 0) ? round(($roi / $total) * 100) : 0;
                                $referral_per = ($total > 0) ? round(($referral / $total) * 100) : 0;
                                //$group_per = ($total > 0) ? round(($group/$total) * 100) : 0;
                                $reinvest_per = ($total > 0) ? round(($reinvest / $total) * 100) : 0;
                                //$coordinator_per = ($total > 0) ? round(($coordinator/$total) * 100) : 0;
                                ?>
                                <div class="row">
                                    <div class="col-md-9 col-sm-9 col-xs-7">
                                        <div class="chart-responsive">
                                            <canvas id="pieChart" height="150"></canvas>
                                        </div>
                                        <!-- ./chart-responsive -->
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-md-3 col-sm-3 col-xs-5">
                                        <ul class="chart-legend clearfix" style="height: 150px;">
                                            <li><i class="fa fa-circle-o text-aqua"></i> <?php echo $roi_per; ?>%</li>
                                            <li><i class="fa fa-circle-o text-red"></i> <?php echo $referral_per; ?>%
                                            </li>
                                            <!-- <li><i class="fa fa-circle-o text-green"></i> <?php echo $group_per; ?>%</li> -->
                                            <li><i class="fa fa-circle-o text-yellow"></i> <?php echo $reinvest_per; ?>%
                                            </li>
                                            <!-- <li><i class="fa fa-circle-o text-primary"></i> <?php echo $coordinator_per; ?>%</li> -->
                                        </ul>
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <!-- /.row -->
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer no-padding">
                                <ul class="nav nav-pills nav-stacked">
                                    <li><a href="javascript:;"><i class="fa fa-circle-o text-aqua"></i> Return on
                                            Investment (ROI) <span
                                                class="pull-right text-aqua"><?php echo USD . number_format($roi, 2); ?></span></a>
                                    </li>
                                    <li><a href="javascript:;"><i class="fa fa-circle-o text-red"></i> Referral bonus
                                            <span
                                                class="pull-right text-red"><?php echo USD . number_format($referral, 2); ?></span></a>
                                    </li>
                                    <!-- <li><a href="javascript:;"><i class="fa fa-circle-o text-green"></i> Cell bonus <span class="pull-right text-green"><?php echo USD . number_format($group, 2); ?></span></a></li> -->
                                    <li><a href="javascript:;"><i class="fa fa-circle-o text-yellow"></i> Reinvest bonus
                                            <span
                                                class="pull-right text-yellow"><?php echo USD . number_format($reinvest, 2); ?></span></a>
                                    </li>
                                    <!-- <li><a href="javascript:;"><i class="fa fa-circle-o text-primary"></i> Coordinator bonus <span class="pull-right text-primary"><?php echo USD . number_format($coordinator, 2); ?></span></a></li> -->
                                </ul>
                            </div>
                            <!-- /.footer -->
                        </div>
                        <!-- /.box -->
                    </div>
                    <!-- /.col -->

                    <div class="col-md-6">
                        <!-- Info Boxes Style 2 -->
                        <div class="info-box bg-red">
                            <span class="info-box-icon"><i class="ion ion-ios-pricetag-outline"></i></span>
                            <?php $level = $this->Util_model->get_info("level", "*", "WHERE id=1"); ?>
                            <div class="info-box-content">
                                <?php
                                $net_worth = $this->Util_model->get_user_info($this->session->userdata(UID), "net_worth", "profile");
                                if ($net_worth > $level['target']) {
                                    $per = 100;
                                } else if ($net_worth < $level['start']) {
                                    $per = 0;
                                } else {
                                    $per = round(get_percentage($level['target'], $net_worth, false), 1);
                                }
                                ?>
                                <span class="info-box-text">
                                    <?php echo $level['name']; ?>
                                    <span class="badge bg-black pull-right" title="Level target achieved"
                                        data-toggle="tooltip"><?php echo $per; ?>%</span>
                                </span>
                                <span class="info-box-number">Target <?php echo USD . number_format($level['target']); ?>
                                    worth</span>

                                <div class="progress">
                                    <div class="progress-bar" style="width: <?php echo $per; ?>%"></div>
                                </div>
                                <span class="progress-description">
                                    <i class="fa fa-trophy" title="Reward at the completion of this level"
                                        data-toggle="tooltip"></i> Coordinator +
                                    <?php echo USD . number_format($level['reward']); ?>
                                </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                        <div class="info-box bg-yellow">
                            <span class="info-box-icon"><i class="ion ion-ios-heart-outline"></i></span>
                            <?php $level = $this->Util_model->get_info("level", "*", "WHERE id=2"); ?>
                            <div class="info-box-content">
                                <?php
                                $net_worth = $this->Util_model->get_user_info($this->session->userdata(UID), "net_worth", "profile");
                                if ($net_worth > $level['target']) {
                                    $per = 100;
                                } else if ($net_worth < $level['start']) {
                                    $per = 0;
                                } else {
                                    $per = round(get_percentage($level['target'], $net_worth, false), 1);
                                }
                                ?>
                                <span class="info-box-text">
                                    <?php echo $level['name']; ?>
                                    <span class="badge bg-black pull-right" title="Level target achieved"
                                        data-toggle="tooltip"><?php echo $per; ?>%</span>
                                </span>
                                <span class="info-box-number">Target <?php echo USD . number_format($level['target']); ?>
                                    worth</span>

                                <div class="progress">
                                    <div class="progress-bar" style="width: <?php echo $per; ?>%"></div>
                                </div>
                                <span class="progress-description">
                                    <i class="fa fa-trophy" title="Reward at the completion of this level"
                                        data-toggle="tooltip"></i> Coordinator +
                                    <?php echo USD . number_format($level['reward']); ?>
                                </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                        <div class="info-box bg-blue">
                            <span class="info-box-icon"><i class="ion ion-ios-star-half"></i></span>
                            <?php $level = $this->Util_model->get_info("level", "*", "WHERE id=3"); ?>
                            <div class="info-box-content">
                                <?php
                                $net_worth = $this->Util_model->get_user_info($this->session->userdata(UID), "net_worth", "profile");
                                if ($net_worth > $level['target']) {
                                    $per = 100;
                                } else if ($net_worth < $level['start']) {
                                    $per = 0;
                                } else {
                                    $per = round(get_percentage($level['target'], $net_worth, false), 1);
                                }
                                ?>
                                <span class="info-box-text">
                                    <?php echo $level['name']; ?>
                                    <span class="badge bg-black pull-right" title="Level target achieved"
                                        data-toggle="tooltip"><?php echo $per; ?>%</span>
                                </span>
                                <span class="info-box-number">Target <?php echo USD . number_format($level['target']); ?>
                                    worth</span>

                                <div class="progress">
                                    <div class="progress-bar" style="width: <?php echo $per; ?>%"></div>
                                </div>
                                <span class="progress-description">
                                    <i class="fa fa-trophy" title="Reward at the completion of this level"
                                        data-toggle="tooltip"></i> Coordinator +
                                    <?php echo USD . number_format($level['reward']); ?>
                                </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                        <div class="info-box bg-green">
                            <span class="info-box-icon"><i class="ion-ios-star"></i></span>
                            <?php $level = $this->Util_model->get_info("level", "*", "WHERE id=4"); ?>
                            <div class="info-box-content">
                                <?php
                                $net_worth = $this->Util_model->get_user_info($this->session->userdata(UID), "net_worth", "profile");
                                if ($net_worth > $level['target']) {
                                    $per = 100;
                                } else if ($net_worth < $level['start']) {
                                    $per = 0;
                                } else {
                                    $per = round(get_percentage($level['target'], $net_worth, false), 1);
                                }
                                ?>
                                <span class="info-box-text">
                                    <?php echo $level['name']; ?>
                                    <span class="badge bg-black pull-right" title="Level target achieved"
                                        data-toggle="tooltip"><?php echo $per; ?>%</span>
                                </span>
                                <span class="info-box-number">Target <?php echo USD . number_format($level['target']); ?>
                                    worth</span>

                                <div class="progress">
                                    <div class="progress-bar" style="width: <?php echo $per; ?>%"></div>
                                </div>
                                <span class="progress-description">
                                    <i class="fa fa-trophy" title="Reward at the completion of this level"
                                        data-toggle="tooltip"></i> Coordinator +
                                    <?php echo USD . number_format($level['reward']); ?>
                                </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.col -->

            <div class="col-md-4 col-sm-12 col-xs-12">
                <!-- RECENT TRANSACTION LIST -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Recent Withdrawal Transactions</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                    class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                    class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <?php
                        $s = $this->Db_model->selectGroup("*", "user_wallet", "WHERE status=1 AND creditor=0 ORDER BY id DESC LIMIT 5");
                        if ($s->num_rows() == 0) {
                            echo "<div class='well'>No transaction found</div>";
                        } else {
                            echo "
                                <div direction='up' behaviour='scroll' scrollamount='5' onmouseover='stop()' onmouseout='start()' height='350' width='100%'>
                                    <ul class='products-list product-list-in-box'>
                                    ";
                            foreach ($s->result_array() as $row) {
                                $uid = $row['debitor'];
                                $desc = $row['desc'];
                                $label = ($row['type'] == 'credit') ? "success" : "danger";
                                $picture = $this->Util_model->picture($uid);
                                $username = $this->Util_model->get_user_info($uid, "username", "profile");
                                $amount = number_format($row['amount']);
                                echo "
                                        <li class='item'>
                                            <div class='product-img'>
                                                <img src='$picture' alt='$username'>
                                            </div>
                                            <div class='product-info'>
                                                <a href='javascript:void(0)' class='product-title'>$username
                                                    <span class='label label-$label pull-right'><i class='fa fa-dollar'></i>$amount</span></a>
                                                <span class='product-description'>
                                                    $desc
                                                </span>
                                            </div>
                                        </li>
                                        <!-- /.item -->
                                        ";
                            }
                            echo "
                                    </ul>
                                </div>
                                ";
                        }
                        ?>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
            

            <div class="col-md-4 col-sm-12 col-xs-12">
                <!-- RECENT TRANSACTION LIST -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Recent Deposit Transactions</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                    class="fa fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                    class="fa fa-times"></i></button>
                        </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <?php
                        $s = $this->Db_model->selectGroup("*", "user_wallet", "WHERE status=1 AND debitor=0 ORDER BY id DESC LIMIT 5");
                        if ($s->num_rows() == 0) {
                            echo "<div class='well'>No transaction found</div>";
                        } else {
                            echo "
                                <div direction='up' behaviour='scroll' scrollamount='5' onmouseover='stop()' onmouseout='start()' height='350' width='100%'>
                                    <ul class='products-list product-list-in-box'>
                                    ";
                            foreach ($s->result_array() as $row) {
                                $uid = $row['creditor'];
                                $desc = $row['desc'];
                                $label = "success";
                                $picture = $this->Util_model->picture($uid);
                                $username = $this->Util_model->get_user_info($uid, "username", "profile");
                                $amount = number_format($row['amount']);
                                echo "
                                        <li class='item'>
                                            <div class='product-img'>
                                                <img src='$picture' alt='$username'>
                                            </div>
                                            <div class='product-info'>
                                                <a href='javascript:void(0)' class='product-title'>$username
                                                    <span class='label label-$label pull-right'><i class='fa fa-dollar'></i>$amount</span></a>
                                                <span class='product-description'>
                                                    $desc
                                                </span>
                                            </div>
                                        </li>
                                        <!-- /.item -->
                                        ";
                            }
                            echo "
                                    </ul>
                                </div>
                                ";
                        }
                        ?>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div>
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>

<!-- ChartJS 1.0.1 -->
<script src="<?php echo base_url(); ?>assets/plugins/chartjs/Chart.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!--<script src="<?php /*echo base_url(); */ ?>assets/dist/js/pages/dashboard2.js"></script>-->
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url(); ?>assets/dist/js/demo.js"></script>

<script>
    $(document).ready(function () {
        'use strict';

        /* ChartJS
         * -------
         * Here we will create a few charts using ChartJS
         */

        //-----------------------
        //- MONTHLY SALES CHART -
        //-----------------------

        <?php
        $s = $this->Db_model->selectGroup("amount, date", "user_bonus", "WHERE creditor=" . $this->session->userdata(UID) . " AND status=1 AND date LIKE '" . date('Y') . "%'");
        $data = array(
            '01' => 0,
            '02' => 0,
            '03' => 0,
            '04' => 0,
            '05' => 0,
            '06' => 0,
            '07' => 0,
            '08' => 0,
            '09' => 0,
            '10' => 0,
            '11' => 0,
            '12' => 0
        );
        foreach ($s->result_array() as $row) {
            $date_ex = explode(" ", $row['date']);
            $date_ex = explode("-", $date_ex[0]);
            $data[$date_ex[1]] += $row['amount'];
        }
        ?>

        // Get context with jQuery - using jQuery's .get() method.
        var salesChartCanvas = $("#salesChart").get(0).getContext("2d");
        // This will get the first returned node in the jQuery collection.
        var salesChart = new Chart(salesChartCanvas);

        var salesChartData = {
            labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            datasets: [
                {
                    label: "Electronics",
                    fillColor: "rgb(210, 214, 222)",
                    strokeColor: "rgb(210, 214, 222)",
                    pointColor: "rgb(210, 214, 222)",
                    pointStrokeColor: "#4d85d1",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgb(220,220,220)",
                    data: [<?php echo $data['01']; ?>, <?php echo $data['02']; ?>, <?php echo $data['03']; ?>, <?php echo $data['04']; ?>, <?php echo $data['05']; ?>, <?php echo $data['06']; ?>, <?php echo $data['07']; ?>, <?php echo $data['08']; ?>, <?php echo $data['09']; ?>, <?php echo $data['10']; ?>, <?php echo $data['11']; ?>, <?php echo $data['12']; ?>]
                }
            ]
        };

        var salesChartOptions = {
            //Boolean - If we should show the scale at all
            showScale: true,
            //Boolean - Whether grid lines are shown across the chart
            scaleShowGridLines: false,
            //String - Colour of the grid lines
            scaleGridLineColor: "rgba(0,0,0,.05)",
            //Number - Width of the grid lines
            scaleGridLineWidth: 1,
            //Boolean - Whether to show horizontal lines (except X axis)
            scaleShowHorizontalLines: true,
            //Boolean - Whether to show vertical lines (except Y axis)
            scaleShowVerticalLines: true,
            //Boolean - Whether the line is curved between points
            bezierCurve: true,
            //Number - Tension of the bezier curve between points
            bezierCurveTension: 0.3,
            //Boolean - Whether to show a dot for each point
            pointDot: false,
            //Number - Radius of each point dot in pixels
            pointDotRadius: 4,
            //Number - Pixel width of point dot stroke
            pointDotStrokeWidth: 1,
            //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
            pointHitDetectionRadius: 20,
            //Boolean - Whether to show a stroke for datasets
            datasetStroke: true,
            //Number - Pixel width of dataset stroke
            datasetStrokeWidth: 2,
            //Boolean - Whether to fill the dataset with a color
            datasetFill: true,
            //String - A legend template
            legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%=datasets[i].label%></li><%}%></ul>",
            //Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
            maintainAspectRatio: true,
            //Boolean - whether to make the chart responsive to window resizing
            responsive: true
        };

        //Create the line chart
        salesChart.Line(salesChartData, salesChartOptions);

        //---------------------------
        //- END MONTHLY SALES CHART -
        //---------------------------

        //-------------
        //- PIE CHART -
        //-------------
        // Get context with jQuery - using jQuery's .get() method.
        var pieChartCanvas = $("#pieChart").get(0).getContext("2d");
        var pieChart = new Chart(pieChartCanvas);
        var PieData = [
            {
                value: <?php echo $roi; ?>,
                color: "#00c0ef",
                highlight: "#00c0ef",
                label: "Return On Investment"
            },
            {
                value: <?php echo $referral; ?>,
                color: "#f56954",
                highlight: "#f56954",
                label: "Referral Bonus"
            },
            /*{
                value: <?php // echo $group; ?>,
            color: "#00a65a",
            highlight: "#00a65a",
            label: "Group Bonus"
            },*/
            {
            value: <?php echo $reinvest; ?>,
            color: "#f39c12",
            highlight: "#f39c12",
            label: "Reinvest Bonus"
        }/*,
            {
                value: <?php // echo $coordinator; ?>,
        color: "#171cef",
        highlight: "#171cef",
        label: "Coordinator Bonus"
            }*/
        ];
    var pieOptions = {
        //Boolean - Whether we should show a stroke on each segment
        segmentShowStroke: true,
        //String - The colour of each segment stroke
        segmentStrokeColor: "#fff",
        //Number - The width of each segment stroke
        segmentStrokeWidth: 1,
        //Number - The percentage of the chart that we cut out of the middle
        percentageInnerCutout: 50, // This is 0 for Pie charts
        //Number - Amount of animation steps
        animationSteps: 100,
        //String - Animation easing effect
        animationEasing: "easeOutBounce",
        //Boolean - Whether we animate the rotation of the Doughnut
        animateRotate: true,
        //Boolean - Whether we animate scaling the Doughnut from the centre
        animateScale: false,
        //Boolean - whether to make the chart responsive to window resizing
        responsive: true,
        // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
        maintainAspectRatio: false,
        //String - A legend template
        legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<segments.length; i++){%><li><span style=\"background-color:<%=segments[i].fillColor%>\"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>",
        //String - A tooltip template
        tooltipTemplate: "<%=value %> <%=label%>"
    };
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    pieChart.Doughnut(PieData, pieOptions);
        //-----------------
        //- END PIE CHART -
        //-----------------
     });
</script>
