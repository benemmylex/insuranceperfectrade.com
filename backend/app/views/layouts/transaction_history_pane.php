<link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/AdminLTE.min.css">
<!-- Bootstrap 3.3.6 -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css">
<!-- custom style -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/util.css">
<!-- Font Awesome -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/font-awesome/css/font-awesome.min.css">
<!-- Ionicons -->
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/ionicons-2.0.1/css/ionicons.min.css">
<!-- jQuery 2.2.3 -->
<script src="<?php echo base_url(); ?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>

<div class="row">
    <div class="col-xs-6">
        <!-- RECENT TRANSACTION LIST -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Recent Withdrawal Transactions</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                            class="fa fa-times"></i></button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <?php
                $s = $this->Db_model->selectGroup("*", "user_wallet", "WHERE status=1 AND creditor=0 ORDER BY id DESC LIMIT 2");
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


    <div class="col-xs-6">
        <!-- RECENT TRANSACTION LIST -->
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Recent Deposit Transactions</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                            class="fa fa-times"></i></button>
                </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <?php
                $s = $this->Db_model->selectGroup("*", "user_wallet", "WHERE status=1 AND debitor=0 ORDER BY id DESC LIMIT 2");
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

<script src="<?php echo base_url(); ?>assets/dist/js/app.min.js"></script>