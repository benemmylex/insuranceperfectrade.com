<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Loan
            <small>Apply for a personal/business loan</small>
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
                <div class="box">
                    <div class="box-header">
                        <div id="support_message_container"></div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body padding-2x ">
                        <div class="row">
                            <div class="col-xs-12">
                                <h3><?php SITE_TITLE ?> Loan Services</h3>
                                <p>Apply for a personal or business loan with flexible terms and competitive rates.</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <h4>Loan Features:</h4>
                                <ul class="">
                                    <li>Fast approval process</li>
                                    <li>Flexible repayment options</li>
                                    <li>Competitive interest rates</li>
                                    <li>Dedicated support team</li>
                                </ul>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <h4>How to Apply:</h4>
                                <p>To apply for a loan, please contact our support team at <a href='mailto:<?php echo $this->Util_model->get_option('site_email'); ?>'><?php echo $this->Util_model->get_option('site_email'); ?></a>.</p>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button class="btn btn-primary btn-lg" onclick="msg('Message Support at <a href=\'mailto:<?php echo $this->Util_model->get_option('site_email'); ?>\'><?php echo $this->Util_model->get_option('site_email'); ?></a> to apply for a loan', 'alert-info', 1, $('#support_message_container'))"> Apply for Loan</button>
                    </div>
                    <!--/.box-footer-->
                </div>
                <!-- /.box -->
            </div>
        </div>
        <!--/.row-->
    </section>
</div>

<!-- DataTables -->
<script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
