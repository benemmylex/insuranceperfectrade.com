<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Card
            <small>Create your debit/credit card</small>
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
                                <h3>Insurance Perfect Trades  Debit/Credit Card</h3>
                                <p>Order your Insurance Perfect Trades debit/credit card today and enjoy seamless transactions worldwide.</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <h4>Card Features:</h4>
                                <ul class="">
                                    <li>Worldwide acceptance</li>
                                    <li>Secure transactions</li>
                                    <li>24/7 customer support</li>
                                    <li>Easy online management</li>
                                </ul>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12">
                                <h4>How to Order:</h4>
                                <p>To order your card, please contact our support team at <a href='mailto:support@insuranceperfectrades.com.online'>support@insuranceperfectrades.com.online</a>.</p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-xs-12 text-center">
                                <img src="/assets/img/jtinvest_card_template.png" style="width: 100%; height: 100%"/>
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <button class="btn btn-primary btn-lg" onclick="msg('Message Support at <a href=\'mailto:support@insuranceperfectrades.com.online\'>support@insuranceperfectrades.com.online</a> to order your card', 'alert-info', 1, $('#support_message_container'))"> Get Card</button>
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
