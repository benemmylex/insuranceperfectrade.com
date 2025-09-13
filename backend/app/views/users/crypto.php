<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Crypto Plan
            <small>Choose your plan, the bigger the better</small>
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
            <?php
            $s = $this->Db_model->selectGroup("*", "plans", "WHERE type='cbd' ORDER BY min_amt");
            if ($s->num_rows() > 0) {
                foreach ($s->result_array() as $row) {
                    echo "
                    <div class='col-md-4'>
                        <!-- Widget: user widget style 1 -->
                        <div class='box box-widget widget-user-2'>
                            <!-- Add the bg color to the header using any of the bg-* classes -->
                            <div class='widget-user-header bg-purple-active'>
                                <div class='widget-user-image'>
                                    <img src='".base_url()."assets/img/package.png' style='width:55px; height:55px;' alt='Plan'>
                                </div>
                                <!-- /.widget-user-image -->
                                <h3 class='widget-user-username'>$row[name]</h3>
                                <h5 class='widget-user-desc'>$row[roi]% ROI After $row[duration] Day(s)</h5>
                            </div>
                            <div class='box-body text-center'>
                                <b>$row[description]</b>
                            </div>
                            <div class='box-footer no-padding'>
                                <div class='col-xs-12 top-pad-3x bottom-pad-3x'>
                                    <div class='input-group'>
                                        <span class='input-group-addon'>USD ($)</span>
                                        <input id='amt$row[id]' step='.01' type='number' min='$row[min_amt]' name='amount' class='form-control text-bold text-center' style='width:100%' placeholder='Min. $".number_format($row['min_amt'])."' onkeyup='invest_amount($(this), \"$row[roi]\", _(\"roi$row[id]\"))'/>
                                    </div>
                                    <div class='well top-1x text-center' style='margin-bottom: 0; padding: 10px 0px; font-size:24px'>
                                        <span class='text-bold' id='roi$row[id]'>$0.00</span>
                                        <small class='text-muted' style='font-size:12px'>ROI</small>
                                    </div>
                                </div>
                                <button class='btn btn-primary btn-flat btn-block btn-invest' type='button' onclick='invest($(this),\"$row[id]\",\"$row[min_amt]\")'>Invest</button>
                            </div>
                        </div>
                        <!-- /.widget-user -->
                    </div>
                    <!-- /.col -->
                    ";
                }
            } else {
                echo "
                <div class='col-xs-12'>
                    <div class='alert alert-warning'>No plan found</div>
                </div>
                ";
            }
            ?>
        </div>
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
