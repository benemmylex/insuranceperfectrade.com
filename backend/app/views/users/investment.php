<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Investment
            <small>All my investments</small>
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
        <div class="row top-2x">
            <div class="col-xs-12">
                <div class="box no-border">
                    <div class="box-header">
                        <h3 class="box-title">Forex Investments</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body no-padding table-responsive">
                        <table class="table table-striped">
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Plan Name</th>
                                <th>Amount</th>
                                <th>Cashout Amount</th>
                                <th>Total Profit</th>
                                <th>Daily Profit</th>
                                <th>ROI</th>
                                <th>Duration</th>
                                <th>Status</th>
                            </tr>
                            <?php
                            $s = $this->Db_model->selectGroup("*", "investment", "WHERE type='forex' AND uid=".$this->session->userdata(UID));
                            if ($s->num_rows() > 0) {
                                $count = 0;
                                foreach ($s->result_array() as $row) {
                                    $count++;
                                    $remain = $row['duration'];
                                    $plan = $this->Util_model->get_info("plans", "*", "WHERE id=$row[plan]");
                                    if ($row['status'] == 0) {
                                        $status = "<span class='label label-success'>Ongoing</span>";
                                    } else if ($row['status'] == 1) {
                                        $status = "<span class='label label-primary'>Ended</span>";
                                    } else {
                                        $status = "<span class='label label-danger'>Cancelled</span>";
                                    }
                                    $duration = (explode(' ',$row['start'])[0] == date_time('d')) ? "<span class='text-yellow'>Next working day</span>" : "$remain days";
                                    $daily = USD.number_format(get_percentage($row['amount'], $plan['roi']), 2);
                                    echo "
                                    <tr>
                                        <td>$count.</td>
                                        <td>$plan[name]</td>
                                        <td>\$".number_format($row['amount'], 2)."</td>
                                        <td>\$".number_format(get_percentage($row['amount'], $plan['cashout']), 2)."</td>
                                        <td>\$".number_format($row['profit'], 2)."</td>
                                        <td>$daily</td>
                                        <td>$plan[roi]%</td>
                                        <td>$duration</td>
                                        <td>$status</td>
                                    </tr>
                                    ";
                                }

                            } else {
                                echo "
                                <tr>
                                    <td colspan='8' class='text-danger'>No CBD investment found</td>
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
