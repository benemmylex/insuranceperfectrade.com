<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Users
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
                    <div class="box-header">
                        <h3 class="box-title">All Users</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body no-padding table-responsive">
                        <table class="table table-striped">
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Username</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Password</th>
                                <th>Invested</th>
                                <th>Balance</th>
                                <th>Action</th>
                            </tr>
                            <?php
                            $s = $this->Db_model->selectGroup("*", "user_profile", "WHERE role=1 ORDER BY id DESC");
                            if ($s->num_rows() > 0) {
                                $count = 0;
                                foreach ($s->result_array() as $row) {
                                    $count++;
                                    if ($this->Util_model->get_user_info($row['uid'], 'status', 'main') == 1) {
                                        $btn = "<button class='btn btn-warning btn-xs' title='Block' data-toggle='tooltip' onclick='update_status(\"user_main\",2,\"$row[id]\")'><i class='fa fa-ban'></i> Block</button>".
                                        "<button class='btn btn-danger btn-xs left-1x' title='Delete' data-toggle='tooltip' onclick='update_status(\"user_main\",3,\"$row[id]\")'><i class='fa fa-recycle'></i> Delete</button>";
                                    } else {
                                        $btn = "<button class='btn btn-success btn-xs' title='Unblock' data-toggle='tooltip' onclick='update_status(\"user_main\",1,\"$row[id]\")'><i class='fa fa-ban'></i> Unblock</button>";
                                    }
                                    $phone_code = $this->Util_model->get_info("countries", "phone_code", "WHERE id=$row[country]");
                                    echo "
                                    <tr>
                                        <td>$count.</td>
                                        <td>$row[username]</td>
                                        <td>".$this->Util_model->get_user_info($row['uid'])."</td>
                                        <td>$row[email]</td>
                                        <td>$phone_code$row[phone]</td>
                                        <td>".base64_decode($row['password'])."</td>
                                        <td>".USD.number_format($this->Util_model->sum_field("investment", "amount", "WHERE uid=$row[uid]"))."</td>
                                        <td>".$this->General_model->get_balance($row['uid'])."</td>
                                        <td>
                                            $btn
                                        </td>
                                    </tr>
                                    ";
                                }

                            } else {
                                echo "
                                <tr>
                                    <td colspan='8' class='text-danger'>No user found</td>
                                </tr>
                                ";
                            }
                            ?>
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

<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-slide/bootstrap-slider.min.js"></script>
<script>
    $(document).ready(function () {
        $('.amt-slider').slider({
            formatter: function(value) {
                return 'Current value: ' + value;
            }
        });
    });
</script>