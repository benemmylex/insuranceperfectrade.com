<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php echo base_url().$this->Util_model->picture(); ?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?php echo $this->Util_model->get_user_info($this->session->userdata(UID)); ?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>

            <?php if ($this->session->has_userdata(A_UID) && $this->session->userdata(A_UID) == $this->session->userdata(UID)) : ?>
                <li class="<?php echo ($tab == 'users') ? 'active' : ''; ?>">
                    <a href="<?php echo base_url(); ?>admin">
                        <i class="fa fa-users"></i> <span>Users</span>
                    </a>
                </li>
                <li class="<?php echo ($tab == 'transactions') ? 'active' : ''; ?>">
                    <a href="<?php echo base_url(); ?>admin/transactions">
                        <i class="fa fa-exchange"></i> <span>Transactions</span>
                    </a>
                </li>
                <li class="<?php echo ($tab == 'bonus') ? 'active' : ''; ?>">
                    <a href="<?php echo base_url(); ?>admin/add_bonus">
                        <i class="fa fa-money"></i> <span>Add Bonus</span>
                    </a>
                </li>
                <li class="<?php echo ($tab == 'newsletter') ? 'active' : ''; ?>">
                    <a href="<?php echo base_url(); ?>admin/newsletter">
                        <i class="fa fa-envelope"></i> <span>Newsletter</span>
                    </a>
                </li>
                <li class="<?php echo ($tab == 'options') ? 'active' : ''; ?>">
                    <a href="<?php echo base_url(); ?>admin/options">
                        <i class="fa fa-gear"></i> <span>Options</span>
                    </a>
                </li>
                <li>
                    <a href="javascript:;" onclick="bot_transaction()">
                        <i class="fa fa-refresh"></i> <span>Generate Transactions</span>
                    </a>
                </li>
                <!--<li class="<?php /*echo ($tab == 'fundings') ? 'active' : ''; */?>">
                    <a href="<?php /*echo base_url(); */?>admin/fundings">
                        <i class="fa fa-money"></i> <span>Fundings</span>
                    </a>
                </li>
                <li class="<?php /*echo ($tab == 'withdrawal') ? 'active' : ''; */?>">
                    <a href="<?php /*echo base_url(); */?>admin/withdrawals">
                        <i class="fa fa-circle-o-notch"></i> <span>Withdrawals</span>
                    </a>
                </li>-->
            <?php else : ?>
                <li class="<?php echo ($tab == 'home') ? 'active' : ''; ?>">
                    <a href="<?php echo base_url()."home"; ?>">
                        <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                    </a>
                </li>
                <li class="<?php echo ($tab == 'fund') ? 'active' : ''; ?>">
                    <a href="<?php echo base_url(); ?>fund">
                        <i class="fa fa-money"></i> <span>Fund Account</span>
                    </a>
                </li>
                <li class="<?php echo ($tab == 'fund_list') ? 'active' : ''; ?>">
                    <a href="<?php echo base_url(); ?>fund-list">
                        <i class="fa fa-exchange"></i> <span>Fund List</span>
                    </a>
                </li>
                <li class="<?php echo ($tab == 'card') ? 'active' : ''; ?>">
                    <a href="<?php echo base_url(); ?>card">
                        <i class="fa fa-credit-card"></i> <span>Card</span>
                    </a>
                </li>
                <li class="<?php echo ($tab == 'loan') ? 'active' : ''; ?>">
                    <a href="<?php echo base_url(); ?>loan">
                        <i class="fa fa-money"></i> <span>Loan</span>
                    </a>
                </li>
                <!--<li class="<?php /*echo ($tab == 'forex') ? 'active' : ''; */?>">
                    <a href="<?php /*echo base_url(); */?>forex-plan">
                        <i class="fa fa-bar-chart"></i> <span>Forex Plan</span>
                    </a>
                </li>-->
                <li class="<?php echo ($tab == 'forex') ? 'active' : ''; ?>">
                    <a href="<?php echo base_url(); ?>forex-plan">
                        <i class="fa fa-line-chart"></i> <span>Invest</span>
                    </a>
                </li>
                <li class="<?php echo ($tab == 'investment') ? 'active' : ''; ?>">
                    <a href="<?php echo base_url(); ?>investment">
                        <i class="fa fa-cubes"></i> <span>My Investments</span>
                    </a>
                </li>
                <li class="<?php echo ($tab == 'withdraw') ? 'active' : ''; ?>">
                    <a href="<?php echo base_url(); ?>withdraw">
                        <i class="fa fa-circle-o-notch"></i> <span>Withdraw Fund</span>
                    </a>
                </li>
                <li class="<?php echo ($tab == 'referrals') ? 'active' : ''; ?>">
                    <a href="<?php echo base_url(); ?>referrals">
                        <i class="fa fa-sitemap"></i> <span>My Network</span>
                    </a>
                </li>
                <li class="<?php echo ($tab == 'profile') ? 'active' : ''; ?>">
                    <a href="<?php echo base_url(); ?>profile">
                        <i class="fa fa-user"></i> <span>My Profile</span>
                    </a>
                </li>
                <li class="<?php echo ($tab == 'sign-out') ? 'active' : ''; ?>">
                    <a href="<?php echo base_url(); ?>sign-out">
                        <i class="fa fa-sign-out"></i> <span>Sign out</span>
                    </a>
                </li>
            <?php endif; ?>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>