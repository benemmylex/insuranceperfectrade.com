<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Newsletter
            <small>Send email messages to your clients</small>
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
                        <?php echo form_open(base_url()."admin/newsletter"); ?>
                        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label>Receiver<span class="text-red">*</span></label>
                                <input class="form-control" name="receiver" required type="text" placeholder="example@example.com">
                                <small>You can use comma to separate multiple emails</small>
                            </div>
                            <div class="form-group">
                                <label>Subject<span class="text-red">*</span> </label>
                                <input class="form-control" name="subject" required type="text">
                            </div>
                            <div class="form-group">
                                <label>Label</label>
                                <input class="form-control" name="label" type="text">
                            </div>
                            <div class="form-group">
                                <label>Button Label</label>
                                <input class="form-control" name="button_label" type="text" placeholder="Visit Our Site">
                            </div>
                            <div class="form-group">
                                <label>Button Link</label>
                                <input class="form-control" name="button_href" type="text" placeholder="Where will viewer be directed when clicked on the button">
                            </div>
                            <div class="form-group">
                                <label>Receiver's Name</label>
                                <input class="form-control" name="name" type="text" placeholder="Optional">
                            </div>
                            <div class="form-group">
                                <label>Message</label>
                                <form method="post" class="form-control">
                                    <textarea name="message summernote"></textarea>
                                </form>
                            </div>
                            <div class="form-group">
                                <label>Additional Text</label>
                                <form method="post" class="form-control">
                                    <textarea name="message summernote"></textarea>
                                </form>
                            </div>
                            <label>&nbsp;</label>
                            <button class="btn btn-success btn-block" type="submit">Send Message</button>
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

<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.16/dist/summernote.min.js"></script>
<script>
    $(document).ready(function() {
        $('.summernote').summernote();
    });
</script>