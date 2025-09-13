<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Add Bonus
            <small>Giving out bonus a good strategy</small>
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
                    <div class="box-body table-responsive top-pad-3x bottom-pad-3x">
                        <?php echo form_open(base_url()."admin/add_bonus"); ?>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            <div class="form-group">
                                <label>Username</label>
                                <input class="form-control" name="username" required type="text">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            <div class="form-group">
                                <label>Amount</label>
                                <input class="form-control" name="amount" required type="number" step="0.01">
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                            <label>&nbsp;</label>
                            <button class="btn btn-success btn-block" type="submit">Add Bonus</button>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
        </div>
        <!--/.row-->
    </section>
</div>