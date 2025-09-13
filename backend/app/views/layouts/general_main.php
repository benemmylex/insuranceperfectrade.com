<!DOCTYPE html>
<!--
Template Name: Savehyip
Version: 1.0.0
Author: Webstrot

-->
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="zxx">

<head>
    <meta charset="utf-8" />
    <title><?php echo SITE_TITLE; ?></title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <meta name="description" content="<?php echo SITE_TITLE; ?>" />
    <meta name="keywords" content="<?php echo SITE_TITLE; ?>,Investment,Cryptocurrency" />
    <meta name="author" content="" />
    <meta name="MobileOptimized" content="320" />
    <!--Template style -->
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/general/css/animate.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/general/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/general/css/fonts.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/general/css/flaticon.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/general/css/font-awesome.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/general/css/owl.carousel.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/general/css/owl.theme.default.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/general/css/nice-select.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/general/css/datatables.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/general/css/dropify.min.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/general/css/reset.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/general/css/magnific-popup.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/general/css/style.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/general/css/responsive.css" />
    <!--favicon-->
    <link rel="shortcut icon" type="image/png" href="<?php echo base_url(); ?>assets/general/images/favicon.png" />
    <!--<script src='../../../google_analytics_auto.js'></script></head>-->
    <script src="<?php echo base_url(); ?>assets/general/js/jquery-3.3.1.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/dist/js/winz-custom.js"></script>
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
    
    <style type="text/css">
        .slider-area .carousel-inner .carousel-item .carousel-captions .content h5{
            font-size: 20px;
            color: #ffffff;
            text-shadow: 0px 0px 5px #34495f;
        }
        
        #translator-wrap {
            position: fixed;
            left: -30px;
            padding: 5px 20px;
            border-radius: 0px 20px 20px 0px;
            bottom: 17%;
            box-shadow: 0px 0px 10px #000;
            background: rgb(255, 255, 255);
            background: linear-gradient(90deg, 
            rgba(2, 0, 36, 1) 0%,
            rgba(16, 15, 96, 1) 0%,
            rgba(27, 27, 143, 1) 0%,
            rgba(40, 39, 128, 1) 0%,
            rgba(84, 135, 204, 1) 64%);
            color: #ffffff;
            z-index: 1000;
        }
        
        #translator-wrap:hover {
            left: 0;
        }
        
        #translator-wrap #translator-element {
            position: relative;
            float: left;
            margin: 10px 20px 10px 0px;
        }
        
        #translator-wrap #translator-icon {
            position: relative;
            float: left;
            font-size: 8px;
            width: 30px;
        }
    </style>
</head>

<body>
    <!-- preloader Start -->
    <div id="preloader">
        <div id="status">
            <img src="<?php echo base_url(); ?>assets/general/images/loader.gif" id="preloader_image" alt="loader">
        </div>
    </div>
    <!-- translator -->
    <div id="translator-wrap">
        <div id="translator-element"></div>
        <script type="text/javascript">
            function googleTranslateElementInit() {
              new google.translate.TranslateElement({pageLanguage: 'en'}, 'translator-element');
              jQuery('.goog-logo-link').css('display', 'none');
              jQuery('.goog-te-gadget').css('font-size', '0');
            }
        </script>
        <div id="translator-icon">
            <img src="https://cdn0.iconfinder.com/data/icons/tuts/256/google_translate.png" width="30px" height="30px"><br>
            Translate
        </div>
    </div>
    <!-- cursor -->
    <div class="cursor"></div>
    <!-- Top Scroll Start -->
    <a href="javascript:" id="return-to-top"> <i class="fas fa-angle-double-up"></i></a>
    <!-- Top Scroll End -->
    <!-- cp navi wrapper Start -->
    <?php if ($tab == 'home') : ?>
    <nav class="cd-dropdown d-block d-sm-block d-md-block d-lg-none d-xl-none">
        <h2><a href="<?php echo base_url(); ?>"> <?php echo SITE_TITLE; ?> </a></h2>
        <a href="#0" class="cd-close">Close</a>
        <ul class="cd-dropdown-content">
            <li><a href="<?php echo base_url(); ?>"> home </a></li>
            <li><a href="<?php echo base_url(); ?>about"> about us </a></li>
            <li><a href="<?php echo base_url(); ?>investment-plan"> investment plans </a></li>
            <li><a href="<?php echo base_url(); ?>faq"> FAQ </a></li>
            <li><a href="<?php echo base_url(); ?>contact"> contact us </a></li>
            <li><a href="<?php echo base_url(); ?>sign-in"> login </a></li>
            <li><a href="<?php echo base_url(); ?>sign-up"> register </a></li>
        </ul>
        <!-- .cd-dropdown-content -->
    </nav>
    <div class="cp_navi_main_wrapper float_left">
        <div class="container-fluid">
            <div class="cp_logo_wrapper">
                <a href="<?php echo base_url(); ?>">
                    <img src="<?php echo base_url(); ?>assets/general/images/logo.png" alt="logo">
                </a>
            </div>
            <!-- mobile menu area start -->
            <header class="mobail_menu d-block d-sm-block d-md-block d-lg-none d-xl-none">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="cd-dropdown-wrapper">
                                <a class="house_toggle" href="#0">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 31.177 31.177" style="enable-background:new 0 0 31.177 31.177;" xml:space="preserve" width="25px" height="25px">
                                            <g>
                                                <g>
                                                    <path class="menubar" d="M30.23,1.775H0.946c-0.489,0-0.887-0.398-0.887-0.888S0.457,0,0.946,0H30.23    c0.49,0,0.888,0.398,0.888,0.888S30.72,1.775,30.23,1.775z" fill="#004165" />
                                                </g>
                                                <g>
                                                    <path class="menubar" d="M30.23,9.126H12.069c-0.49,0-0.888-0.398-0.888-0.888c0-0.49,0.398-0.888,0.888-0.888H30.23    c0.49,0,0.888,0.397,0.888,0.888C31.118,8.729,30.72,9.126,30.23,9.126z" fill="#004165" />
                                                </g>
                                                <g>
                                                    <path class="menubar" d="M30.23,16.477H0.946c-0.489,0-0.887-0.398-0.887-0.888c0-0.49,0.398-0.888,0.887-0.888H30.23    c0.49,0,0.888,0.397,0.888,0.888C31.118,16.079,30.72,16.477,30.23,16.477z" fill="#004165" />
                                                </g>
                                                <g>
                                                    <path class="menubar" d="M30.23,23.826H12.069c-0.49,0-0.888-0.396-0.888-0.887c0-0.49,0.398-0.888,0.888-0.888H30.23    c0.49,0,0.888,0.397,0.888,0.888C31.118,23.43,30.72,23.826,30.23,23.826z" fill="#004165" />
                                                </g>
                                                <g>
                                                    <path class="menubar" d="M30.23,31.177H0.946c-0.489,0-0.887-0.396-0.887-0.887c0-0.49,0.398-0.888,0.887-0.888H30.23    c0.49,0,0.888,0.398,0.888,0.888C31.118,30.78,30.72,31.177,30.23,31.177z" fill="#004165" />
                                                </g>
                                            </g>
                                        </svg>
                                </a>
                                <!-- .cd-dropdown -->

                            </div>
                        </div>
                    </div>
                </div>
                <!-- .cd-dropdown-wrapper -->
            </header>
            <div class="top_header_right_wrapper">
                <p><i class="flaticon-phone-contact"></i> (+1) 315 262 8887</p>
                <div class="header_btn">
                    <ul>
                        <li>
                            <a href="<?php echo base_url(); ?>sign-up"> register </a> </li>
                        <li>
                            <a href="<?php echo base_url(); ?>sign-in"> login </a> </li>
                    </ul>


                </div>
            </div>

            <div class="cp_navigation_wrapper">
                <div class="mainmenu d-xl-block d-lg-block d-md-none d-sm-none d-none">
                    <ul class="main_nav_ul">
                        <li><a href="<?php echo base_url(); ?>" class="gc_main_navigation">home</a></li>
                        <li><a href="<?php echo base_url(); ?>about" class="gc_main_navigation">about us</a></li>
                        <li><a href="<?php echo base_url(); ?>investment-plan" class="gc_main_navigation">investment plans</a></li>
                        <li><a href="<?php echo base_url(); ?>faq" class="gc_main_navigation">FAQ</a></li>
                        <li><a href="<?php echo base_url(); ?>contact" class="gc_main_navigation">contact us</a></li>
                        
                    </ul>
                    <div id="google_translate_element" style="padding-top:20px; padding-left:20px"></div>
                    <script type="text/javascript">
                    function googleTranslateElementInit() {
                      new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
                      jQuery('.goog-logo-link').css('display', 'none');
                      jQuery('.goog-te-gadget').css('font-size', '0');
                    }
                    </script>
                </div>
                <!-- mainmenu end -->
            </div>
        </div>
    </div>
    <?php else : ?>
    <nav class="cd-dropdown d-block d-sm-block d-md-block d-lg-none d-xl-none">
        <h2><a href="index.html"> <?php echo SITE_TITLE; ?> </a></h2>
        <a href="#0" class="cd-close">Close</a>
        <ul class="cd-dropdown-content">
            <li>
                <form class="cd-search">
                    <input type="search" placeholder="Search...">
                </form>
            </li>
            <li><a href="<?php echo base_url(); ?>"> home </a></li>
            <li><a href="<?php echo base_url(); ?>about"> about us </a></li>
            <li><a href="<?php echo base_url(); ?>investment-plan"> investment plans </a></li>
            <li><a href="<?php echo base_url(); ?>faq"> FAQ </a></li>
            <li><a href="<?php echo base_url(); ?>contact"> contact us </a></li>
            <li><a href="<?php echo base_url(); ?>sign-in"> login </a></li>
            <li><a href="<?php echo base_url(); ?>sign-up"> register </a></li>
        </ul>
        <!-- .cd-dropdown-content -->
    </nav>
    <div class="cp_navi_main_wrapper inner_header_wrapper float_left">
        <div class="container-fluid">
            <div class="cp_logo_wrapper">
                <a href="<?php echo base_url(); ?>">
                    <img src="<?php echo base_url(); ?>assets/general/images/logo2.png" alt="logo">
                </a>
            </div>
            <!-- mobile menu area start -->
            <header class="mobail_menu d-block d-sm-block d-md-block d-lg-none d-xl-none">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="cd-dropdown-wrapper">
                                <a class="house_toggle inner_toggle" href="#0">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 31.177 31.177" style="enable-background:new 0 0 31.177 31.177;" xml:space="preserve" width="25px" height="25px">
                                        <g>
                                            <g>
                                                <path class="menubar" d="M30.23,1.775H0.946c-0.489,0-0.887-0.398-0.887-0.888S0.457,0,0.946,0H30.23    c0.49,0,0.888,0.398,0.888,0.888S30.72,1.775,30.23,1.775z" fill="#004165" />
                                            </g>
                                            <g>
                                                <path class="menubar" d="M30.23,9.126H12.069c-0.49,0-0.888-0.398-0.888-0.888c0-0.49,0.398-0.888,0.888-0.888H30.23    c0.49,0,0.888,0.397,0.888,0.888C31.118,8.729,30.72,9.126,30.23,9.126z" fill="#004165" />
                                            </g>
                                            <g>
                                                <path class="menubar" d="M30.23,16.477H0.946c-0.489,0-0.887-0.398-0.887-0.888c0-0.49,0.398-0.888,0.887-0.888H30.23    c0.49,0,0.888,0.397,0.888,0.888C31.118,16.079,30.72,16.477,30.23,16.477z" fill="#004165" />
                                            </g>
                                            <g>
                                                <path class="menubar" d="M30.23,23.826H12.069c-0.49,0-0.888-0.396-0.888-0.887c0-0.49,0.398-0.888,0.888-0.888H30.23    c0.49,0,0.888,0.397,0.888,0.888C31.118,23.43,30.72,23.826,30.23,23.826z" fill="#004165" />
                                            </g>
                                            <g>
                                                <path class="menubar" d="M30.23,31.177H0.946c-0.489,0-0.887-0.396-0.887-0.887c0-0.49,0.398-0.888,0.887-0.888H30.23    c0.49,0,0.888,0.398,0.888,0.888C31.118,30.78,30.72,31.177,30.23,31.177z" fill="#004165" />
                                            </g>
                                        </g>
                                    </svg>
                                </a>
                                <!-- .cd-dropdown -->

                            </div>
                        </div>
                    </div>
                </div>
                <!-- .cd-dropdown-wrapper -->
            </header>
            <div class="top_header_right_wrapper">
                <p><i class="flaticon-phone-contact"></i> (+1) 315 262 8887</p>
                <div class="header_btn">
                    <ul>
                        <li>
                            <a href="<?php echo base_url(); ?>sign-up"> register </a> </li>
                        <li>
                            <a href="<?php echo base_url(); ?>sign-in"> login </a> </li>
                    </ul>

                </div>
            </div>

            <div class="cp_navigation_wrapper main_top_wrapper">
                <div class="mainmenu d-xl-block d-lg-block d-md-none d-sm-none d-none">
                    <ul class="main_nav_ul">
                        <li><a href="<?php echo base_url(); ?>" class="gc_main_navigation">home</a></li>
                        <li><a href="<?php echo base_url(); ?>about" class="gc_main_navigation">about us</a></li>
                        <li><a href="<?php echo base_url(); ?>investment-plan" class="gc_main_navigation">investment plans</a></li>
                        <li><a href="<?php echo base_url(); ?>faq" class="gc_main_navigation">FAQ</a></li>
                        <li><a href="<?php echo base_url(); ?>contact" class="gc_main_navigation">contact us</a></li>
                    </ul>
                </div>
                <!-- mainmenu end -->
            </div>
        </div>
    </div>
    <?php endif; ?>
    <!-- cp navi wrapper End -->

    <?php $this->load->view($main_content); ?>

    <!-- footer section start-->
    <div class="footer_main_wrapper float_left">

        <div class="container">

            <div class="row">

                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="wrapper_second_about">
                        <div class="wrapper_first_image">
                            <a href="index.html"><img src="<?php echo base_url(); ?>assets/general/images/logo.png" class="img-responsive" alt="logo" /></a>
                        </div>
                        <p>We put your investing ideas into action with full range of investments.</p>
                        <div class="counter-section">
                            <div class="ft_about_icon float_left">
                                <i class="flaticon-user"></i>
                                <div class="ft_abt_text_wrapper">
                                    <p class="timer"> 11541</p>
                                    <h4>total member</h4>
                                </div>

                            </div>
                            <div class="ft_about_icon float_left">
                                <i class="flaticon-money-bag"></i>
                                <div class="ft_abt_text_wrapper">
                                    <p class="timer">12348562</p>
                                    <h4>total deposited</h4>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">
                    <div class="wrapper_second_useful">
                        <h4>usefull links </h4>

                        <ul>
                            <li><a href="<?php echo base_url(); ?>about"><i class="fa fa-angle-right"></i>About us</a>
                            </li>

                            <li><a href="<?php echo base_url(); ?>contact"><i class="fa fa-angle-right"></i>contact </a>
                            </li>
                            <li><a href="<?php echo base_url(); ?>investment-plan"><i class="fa fa-angle-right"></i>Investment Plans</a>
                            </li>
                            <li><a href="<?php echo base_url(); ?>faq"><i class="fa fa-angle-right"></i>FAQ</a> </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-6 col-xs-6">
                    <div class="wrapper_second_useful wrapper_second_links">

                        <ul>
                            <li><a href="<?php echo base_url(); ?>home"><i class="fa fa-angle-right"></i>Dashboard</a>
                            </li>
                            <li><a href="<?php echo base_url(); ?>deposit"><i class="fa fa-angle-right"></i>Fund Account</a>
                            </li>
                            <li><a href="<?php echo base_url(); ?>wallet/withdraw"><i class="fa fa-angle-right"></i>Withdraw </a>
                            </li>
                            <li><a href="<?php echo base_url(); ?>crpto-plan"><i class="fa fa-angle-right"></i>Invest</a>
                            </li>
                        </ul>

                    </div>
                </div>

                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="wrapper_second_useful wrapper_second_useful_2">
                        <h4>contact  us</h4>
                        <ul>
                            <li>
                                <h1>Live Support <i class='fa fa-support'></i></h1></li>
                            <li><a href="#"><i class="flaticon-mail"></i>support@<?php echo $this->Util_model->get_option("site_url"); ?></a>
                            </li>
                            <li><a href="#"><i class="flaticon-language"></i>www.<?php echo $this->Util_model->get_option("site_url"); ?></a>
                            </li>

                            <!-- <li><i class="flaticon-placeholder"></i><?php //echo $this->Util_model->get_option("site_address"); ?>
                            </li> -->
                        </ul>
                    </div>
                </div>

                <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                    <div class="copyright_wrapper">
                        <div class="copyright text-center">
                            <p>Copyright <i class="far fa-copyright"></i> <?php echo date('Y'); ?> <a href="<?php echo base_url(); ?>"> <?php echo SITE_TITLE; ?></a>.</p>
                        </div>
                        <!-- <div class="social_link_foter">

                            <ul>
                                <li><a href="https://www.facebook.com/nexocoin.co"><i class="fab fa-facebook-f"></i></a></li>
                                <li><a href="https://wa.link/jm1hst"><i class="fab fa-whatsapp"></i></a></li>

                            </ul>
                        </div> -->
                    </div>
                </div>
            </div>

        </div>
    </div>
    <footer style="bottom: -30px; height: 75px; width: 100%; position: fixed; z-index: 1000">
        <!-- TradingView Widget BEGIN -->
        <div class="tradingview-widget-container">
            <div class="tradingview-widget-container__widget"></div>
            <div class="tradingview-widget-copyright"><a href="https://www.tradingview.com" rel="noopener" target="_blank"><span class="blue-text">Ticker Tape</span></a> by TradingView</div>
            <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-ticker-tape.js" async>
                {
                    "symbols": [
                    {
                        "title": "S&P 500",
                        "proName": "OANDA:SPX500USD"
                    },
                    {
                        "title": "Nasdaq 100",
                        "proName": "OANDA:NAS100USD"
                    },
                    {
                        "title": "EUR/USD",
                        "proName": "FX_IDC:EURUSD"
                    },
                    {
                        "title": "BTC/USD",
                        "proName": "BITSTAMP:BTCUSD"
                    },
                    {
                        "title": "ETH/USD",
                        "proName": "BITSTAMP:ETHUSD"
                    }
                ],
                    "colorTheme": "light",
                    "isTransparent": false,
                    "displayMode": "adaptive",
                    "locale": "en"
                }
            </script>
        </div>
        <!-- TradingView Widget END -->
    </footer>
    <!-- footer section end-->

    <a href="https://api.whatsapp.com/send?phone=447835206709>&text=Hello!%20Please%20I%20need%20help" target="_blank" style="position: fixed; right:35px; width:50px; height:50px; border-radius:50%; bottom:130px; padding:9px 11px;">
        <img src="<?php echo base_url(); ?>assets/general/images/whatsapp.png" style="width:50px; height:50px;">
    </a>

    <!--custom js files-->
    <script src="<?php echo base_url(); ?>assets/general/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/general/js/modernizr.js"></script>
    <script src="<?php echo base_url(); ?>assets/general/js/jquery.menu-aim.js"></script>
    <script src="<?php echo base_url(); ?>assets/general/js/plugin.js"></script>
    <script src="<?php echo base_url(); ?>assets/general/js/jquery.countTo.js"></script>
    <script src="<?php echo base_url(); ?>assets/general/js/dropify.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/general/js/datatables.js"></script>
    <script src="<?php echo base_url(); ?>assets/general/js/jquery.nice-select.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/general/js/jquery.inview.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/general/js/jquery.magnific-popup.js"></script>
    <script src="<?php echo base_url(); ?>assets/general/js/owl.carousel.js"></script>
    <script src="<?php echo base_url(); ?>assets/general/js/calculator.js"></script>
    <script src="<?php echo base_url(); ?>assets/general/js/custom.js"></script>
    <!-- custom js-->
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

</body>

<!-- Smartsupp Live Chat script -->
<script type="text/javascript">
var _smartsupp = _smartsupp || {};
_smartsupp.key = '21aba9a2ad84b7a6f6bdbbda711b2471628b11cc';
window.smartsupp||(function(d) {
  var s,c,o=smartsupp=function(){ o._.push(arguments)};o._=[];
  s=d.getElementsByTagName('script')[0];c=d.createElement('script');
  c.type='text/javascript';c.charset='utf-8';c.async=true;
  c.src='https://www.smartsuppchat.com/loader.js?';s.parentNode.insertBefore(c,s);
})(document);
</script>
<noscript> Powered by <a href=“https://www.smartsupp.com” target=“_blank”>Smartsupp</a></noscript>

</html>