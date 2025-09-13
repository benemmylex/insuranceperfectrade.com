    <div class="container no-padding" id="home-slide-pane">
        <div class="intro-header box-border">
            <div class="row" style="background-color: white">
                <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12 md-0 no-padding">
                    <div class="margin"></div>
                    <ul class="nav nav-pills nav-stacked" id="nav-link">
                        <li class="no-padding" style="margin-top: 0px">
                            <span class="text-bold left-pad-2x font-2x">Popular</span>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>data-bundle" style="color: #18384C; background: none;">
                                <i class="fa fa-calendar"></i> Today's fixtures
                                <span class="pull-right">
                                    <i class="fa fa-angle-right"></i>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>bulk-sms" style="color: #18384C; background: none;">
                                <i class="ion ion-ios-home"></i> Own a base
                                <span class="pull-right">
                                    <i class="fa fa-angle-right"></i>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>airtime" style="color: #18384C; background: none;">
                                <i class="fa fa-angle-right"></i>
                                <span class="pull-right">
                                    <i class="fa fa-angle-double-right"></i>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>store" style="color: #18384C; background: none;">
                                Store
                                <span class="pull-right">
                                    <i class="fa fa-angle-double-right"></i>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url(); ?>#loan" style="color: #18384C; background: none;">
                                Loan
                                <span class="pull-right">
                                    <i class="fa fa-angle-double-right"></i>
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-7 col-md-7 col-sm-8 col-xs-12 no-padding">
                    <ul class="rslides">
                        <li><img src="<?php echo base_url(); ?>assets/img/slider/bettor3.jpg" alt="IseBaba Slider 2"></li>
                        <li><img src="<?php echo base_url(); ?>assets/img/slider/predictor2.jpg" alt="IseBaba Slider 3"></li>
                        <li><img src="<?php echo base_url(); ?>assets/img/slider/predictor3.jpg" alt="IseBaba Slider 4"></li>
                        <li><img src="<?php echo base_url(); ?>assets/img/slider/predictor4.jpg" alt="IseBaba Slider 5"></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 sm-0 no-padding">
                    <a href="<?php echo base_url(); ?>assets/IseBaba.apk" download>
                        <img src="<?php echo base_url(); ?>assets/img/photo1.png" style="width: 100%;">
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!--Responsive slider-->
    <script src="<?php echo base_url(); ?>assets/plugins/ResponsiveSlides/responsiveslides.min.js"></script>
    <script>
        $(document).ready(function() {
            $(".rslides").responsiveSlides();
        });
    </script>