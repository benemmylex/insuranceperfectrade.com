<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Transactions
            <small>All the users of the program</small>
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
                    <div class="box-header with-border">
                        <h3 class="box-title">Deposit/Withdrawal</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body table-responsive">
                        <table id="transTable" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th class="text-center">Time</th>
                                <th class="text-center">Type</th>
                                <th class="text-center">Details</th>
                                <th class="text-center">Reference</th>
                                <th class="text-center">From</th>
                                <th class="text-center">To</th>
                                <th class="text-center">Amount</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Balance</th>
                                <th class="text-center"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $s = $this->Db_model->selectGroup("*", "user_wallet", "ORDER BY id DESC");
                            if ($s->num_rows() > 0) {
                                $balance = 0;
                                $total_bal = $this->General_model->get_balance($this->session->userdata(UID), false);
                                $bal = $total_bal;
                                foreach ($s->result_array() as $row) {
                                    $amount = ($row['creditor'] == $this->session->userdata(UID)) ? $row['amount'] : $row['amount'] * -1;
                                    $balance += ($row['status'] == 1) ? $amount : 0;

                                    if ($row['status'] == 0) {
                                        $status = "<span class='text-red'>Pending</span>";
                                    } else if ($row['status'] == 1) {
                                        $status = "<span class='text-green'>Success</span>";
                                    } else if ($row['status'] == 2) {
                                        $status = "<span class='text-gray'>Failed</span>";
                                    }
                                    $bal = ($row['status'] == 1) ? number_format($bal, 2) : "";
                                    $from = ($row['debitor'] == 0)?"System":$this->Util_model->get_user_info($row['debitor'],'username','profile');
                                    $to = ($row['creditor'] == 0)?"System":$this->Util_model->get_user_info($row['creditor'],'username','profile');
                                    echo "
                            <tr class='text-center'>
                                <td>$row[date]</td>
                                <td>$row[type]</td>
                                <td>$row[extra]</td>
                                <td>$row[ref]</td>
                                <td>$from</td>
                                <td>$to</td>
                                <td>".number_format($amount, 2)."</td>
                                <td>$status</td>
                                <td>$bal</td>
                                <td>
                                    <button class='btn btn-danger btn-xs' type='button' title='Decline' data-toggle='tooltip' onclick='update_status(\"user_wallet\",2,\"$row[id]\")'><i class='fa fa-times'></i></button>
                                    <button class='btn btn-warning btn-xs' type='button' title='Pending' data-toggle='tooltip' onclick='update_status(\"user_wallet\",0,\"$row[id]\")'><i class='fa fa-spinner'></i></button>
                                    <button class='btn btn-success btn-xs' type='button' title='Success' data-toggle='tooltip' onclick='update_status(\"user_wallet\",1,\"$row[id]\")'><i class='fa fa-check'></i></button>
                                </td>
                            </tr>\n
                        ";


                                    $bal = $total_bal - $balance;
                                }
                            }
                            ?>
                            </tbody>
                        </table>
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

<!-- DataTables -->
<script src="<?php echo base_url(); ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>

<script>
    $(function () {

        $('#transTable').DataTable({
            "order":[0, "desc"]
        });

    });
</script>
